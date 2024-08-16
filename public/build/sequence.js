(self["webpackChunk"] = self["webpackChunk"] || []).push([["sequence"],{

/***/ "./assets/javascript/sequencescript.js":
/*!*********************************************!*\
  !*** ./assets/javascript/sequencescript.js ***!
  \*********************************************/
/***/ (() => {

// script associated to editsequence.html.twig

document.addEventListener('DOMContentLoaded', function () {
  var changeDocSelect = document.getElementById('sequence_form_changeImage');
  var editFileDiv = document.getElementById('editFile');

  // Set the default value to 'no' on page load
  changeDocSelect.value = 'no';
  editFileDiv.classList.add('d-none'); // Ensure the file div is hidden

  // Handle the change event
  changeDocSelect.addEventListener('change', function () {
    if (changeDocSelect.value === 'yes') {
      editFileDiv.classList.remove('d-none');
    } else {
      editFileDiv.classList.add('d-none');
    }
  });
});

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ var __webpack_exports__ = (__webpack_exec__("./assets/javascript/sequencescript.js"));
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoic2VxdWVuY2UuanMiLCJtYXBwaW5ncyI6Ijs7Ozs7Ozs7QUFBQTs7QUFFQUEsUUFBUSxDQUFDQyxnQkFBZ0IsQ0FBQyxrQkFBa0IsRUFBRSxZQUFNO0VBQ2hELElBQU1DLGVBQWUsR0FBR0YsUUFBUSxDQUFDRyxjQUFjLENBQUMsMkJBQTJCLENBQUM7RUFDNUUsSUFBTUMsV0FBVyxHQUFHSixRQUFRLENBQUNHLGNBQWMsQ0FBQyxVQUFVLENBQUM7O0VBRXZEO0VBQ0FELGVBQWUsQ0FBQ0csS0FBSyxHQUFHLElBQUk7RUFDNUJELFdBQVcsQ0FBQ0UsU0FBUyxDQUFDQyxHQUFHLENBQUMsUUFBUSxDQUFDLENBQUMsQ0FBQzs7RUFFckM7RUFDQUwsZUFBZSxDQUFDRCxnQkFBZ0IsQ0FBQyxRQUFRLEVBQUUsWUFBTTtJQUM3QyxJQUFHQyxlQUFlLENBQUNHLEtBQUssS0FBSyxLQUFLLEVBQUU7TUFDaENELFdBQVcsQ0FBQ0UsU0FBUyxDQUFDRSxNQUFNLENBQUMsUUFBUSxDQUFDO0lBQzFDLENBQUMsTUFBTTtNQUNISixXQUFXLENBQUNFLFNBQVMsQ0FBQ0MsR0FBRyxDQUFDLFFBQVEsQ0FBQztJQUN2QztFQUNKLENBQUMsQ0FBQztBQUNOLENBQUMsQ0FBQyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL2Fzc2V0cy9qYXZhc2NyaXB0L3NlcXVlbmNlc2NyaXB0LmpzIl0sInNvdXJjZXNDb250ZW50IjpbIi8vIHNjcmlwdCBhc3NvY2lhdGVkIHRvIGVkaXRzZXF1ZW5jZS5odG1sLnR3aWdcclxuXHJcbmRvY3VtZW50LmFkZEV2ZW50TGlzdGVuZXIoJ0RPTUNvbnRlbnRMb2FkZWQnLCAoKSA9PiB7XHJcbiAgICBjb25zdCBjaGFuZ2VEb2NTZWxlY3QgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnc2VxdWVuY2VfZm9ybV9jaGFuZ2VJbWFnZScpO1xyXG4gICAgY29uc3QgZWRpdEZpbGVEaXYgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnZWRpdEZpbGUnKTtcclxuXHJcbiAgICAvLyBTZXQgdGhlIGRlZmF1bHQgdmFsdWUgdG8gJ25vJyBvbiBwYWdlIGxvYWRcclxuICAgIGNoYW5nZURvY1NlbGVjdC52YWx1ZSA9ICdubyc7XHJcbiAgICBlZGl0RmlsZURpdi5jbGFzc0xpc3QuYWRkKCdkLW5vbmUnKTsgLy8gRW5zdXJlIHRoZSBmaWxlIGRpdiBpcyBoaWRkZW5cclxuXHJcbiAgICAvLyBIYW5kbGUgdGhlIGNoYW5nZSBldmVudFxyXG4gICAgY2hhbmdlRG9jU2VsZWN0LmFkZEV2ZW50TGlzdGVuZXIoJ2NoYW5nZScsICgpID0+IHtcclxuICAgICAgICBpZihjaGFuZ2VEb2NTZWxlY3QudmFsdWUgPT09ICd5ZXMnKSB7XHJcbiAgICAgICAgICAgIGVkaXRGaWxlRGl2LmNsYXNzTGlzdC5yZW1vdmUoJ2Qtbm9uZScpO1xyXG4gICAgICAgIH0gZWxzZSB7XHJcbiAgICAgICAgICAgIGVkaXRGaWxlRGl2LmNsYXNzTGlzdC5hZGQoJ2Qtbm9uZScpO1xyXG4gICAgICAgIH1cclxuICAgIH0pO1xyXG59KTtcclxuIl0sIm5hbWVzIjpbImRvY3VtZW50IiwiYWRkRXZlbnRMaXN0ZW5lciIsImNoYW5nZURvY1NlbGVjdCIsImdldEVsZW1lbnRCeUlkIiwiZWRpdEZpbGVEaXYiLCJ2YWx1ZSIsImNsYXNzTGlzdCIsImFkZCIsInJlbW92ZSJdLCJzb3VyY2VSb290IjoiIn0=