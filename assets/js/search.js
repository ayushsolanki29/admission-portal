document.addEventListener("DOMContentLoaded", function () {
  const searchInputs = document.querySelectorAll(".search-input");
  const autocompleteSuggestions = document.querySelectorAll(
    ".autocomplete-suggestions"
  );

  // Event listener for each search input
  searchInputs.forEach(function (searchInput, index) {
    const suggestionsContainer = autocompleteSuggestions[index];

    // Event listener for input change
    searchInput.addEventListener("input", function () {
      if (searchInput.value.trim() === "") {
        suggestionsContainer.style.display = "none";
      } else {
        suggestionsContainer.style.display = "block";
      }

      getSuggestions(searchInput.value, suggestionsContainer); // Call getSuggestions with current input value
    });

    // Event listener for document click to hide suggestions
    document.addEventListener("click", function (event) {
      if (
        !searchInput.contains(event.target) &&
        !suggestionsContainer.contains(event.target)
      ) {
        suggestionsContainer.style.display = "none";
      }
    });
  });

  function getSuggestions(searchValue, suggestionsContainer) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "php/utils/getSuggestions.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        // Display the autocomplete suggestions
        suggestionsContainer.innerHTML = xhr.responseText;
      }
    };
    xhr.send("searchIn=" + searchValue);
  }

  // Function to select suggestion
  function selectSuggestion(value, searchInput, suggestionsContainer) {
    searchInput.value = value;
    suggestionsContainer.innerHTML = ""; // Clear suggestions after selection
  }
});
// click on this #search_btn btn and submit this .input-form
document.getElementById("search_btn").addEventListener("click", function () {
  document.querySelector(".input-form").submit();
});
