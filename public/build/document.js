(self["webpackChunk"] = self["webpackChunk"] || []).push([["document"],{

/***/ "./assets/javascript/documentscript.js":
/*!*********************************************!*\
  !*** ./assets/javascript/documentscript.js ***!
  \*********************************************/
/***/ (() => {

// script associated to both editdocument.html.twig and adddocument.html.twig

var fileTypeInput = document.getElementById('document_form_type');
checkFileType();

// checks the chosen file type

function checkFileType() {
  var uploadFileInput = document.getElementById('document_form_file_path');
  var addLinkInput = document.getElementById('document_form_link_path');
  if (fileTypeInput.value === 'lien' || fileTypeInput.value === 'video') {
    // if user selects link or video, the displayed field is a text type 
    uploadFileInput.parentElement.classList.add('d-none');
    addLinkInput.parentElement.classList.remove('d-none');
  } else {
    // in the case of others docs, a file type field appears to upload a document 
    addLinkInput.parentElement.classList.add('d-none');
    uploadFileInput.parentElement.classList.remove('d-none');
  }
}
fileTypeInput.addEventListener('change', function () {
  checkFileType();
});

// concerning editdocument.html.twig
// shows or hides the change of file depending on user's choice

var changeDocSelect = document.getElementById('document_form_changedoc');
var editFileDiv = document.getElementById('editFile');
changeDocSelect.addEventListener('change', function () {
  if (changeDocSelect.value == 'changeDocYes') {
    editFileDiv.classList.remove('d-none');
  } else {
    editFileDiv.classList.add('d-none');
  }
});

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ var __webpack_exports__ = (__webpack_exec__("./assets/javascript/documentscript.js"));
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiZG9jdW1lbnQuanMiLCJtYXBwaW5ncyI6Ijs7Ozs7Ozs7QUFBQTs7QUFFQSxJQUFNQSxhQUFhLEdBQUdDLFFBQVEsQ0FBQ0MsY0FBYyxDQUFDLG9CQUFvQixDQUFDO0FBQzNEQyxhQUFhLENBQUMsQ0FBQzs7QUFFZjs7QUFFQSxTQUFTQSxhQUFhQSxDQUFBLEVBQUc7RUFDckIsSUFBTUMsZUFBZSxHQUFHSCxRQUFRLENBQUNDLGNBQWMsQ0FBQyx5QkFBeUIsQ0FBQztFQUMxRSxJQUFNRyxZQUFZLEdBQUdKLFFBQVEsQ0FBQ0MsY0FBYyxDQUFDLHlCQUF5QixDQUFDO0VBRXZFLElBQUdGLGFBQWEsQ0FBQ00sS0FBSyxLQUFLLE1BQU0sSUFBSU4sYUFBYSxDQUFDTSxLQUFLLEtBQUssT0FBTyxFQUFFO0lBQ2xFO0lBQ0FGLGVBQWUsQ0FBQ0csYUFBYSxDQUFDQyxTQUFTLENBQUNDLEdBQUcsQ0FBQyxRQUFRLENBQUM7SUFDckRKLFlBQVksQ0FBQ0UsYUFBYSxDQUFDQyxTQUFTLENBQUNFLE1BQU0sQ0FBQyxRQUFRLENBQUM7RUFFekQsQ0FBQyxNQUFNO0lBQ0g7SUFDQUwsWUFBWSxDQUFDRSxhQUFhLENBQUNDLFNBQVMsQ0FBQ0MsR0FBRyxDQUFDLFFBQVEsQ0FBQztJQUNsREwsZUFBZSxDQUFDRyxhQUFhLENBQUNDLFNBQVMsQ0FBQ0UsTUFBTSxDQUFDLFFBQVEsQ0FBQztFQUM1RDtBQUNKO0FBRUFWLGFBQWEsQ0FBQ1csZ0JBQWdCLENBQUMsUUFBUSxFQUFFLFlBQU07RUFDM0NSLGFBQWEsQ0FBQyxDQUFDO0FBRW5CLENBQUMsQ0FBQzs7QUFFVjtBQUNBOztBQUVBLElBQU1TLGVBQWUsR0FBR1gsUUFBUSxDQUFDQyxjQUFjLENBQUMseUJBQXlCLENBQUM7QUFDMUUsSUFBTVcsV0FBVyxHQUFHWixRQUFRLENBQUNDLGNBQWMsQ0FBQyxVQUFVLENBQUM7QUFFdkRVLGVBQWUsQ0FBQ0QsZ0JBQWdCLENBQUMsUUFBUSxFQUFFLFlBQU07RUFDN0MsSUFBR0MsZUFBZSxDQUFDTixLQUFLLElBQUksY0FBYyxFQUFFO0lBQ3hDTyxXQUFXLENBQUNMLFNBQVMsQ0FBQ0UsTUFBTSxDQUFDLFFBQVEsQ0FBQztFQUMxQyxDQUFDLE1BQU07SUFDSEcsV0FBVyxDQUFDTCxTQUFTLENBQUNDLEdBQUcsQ0FBQyxRQUFRLENBQUM7RUFDdkM7QUFDSixDQUFDLENBQUMiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvamF2YXNjcmlwdC9kb2N1bWVudHNjcmlwdC5qcyJdLCJzb3VyY2VzQ29udGVudCI6WyIvLyBzY3JpcHQgYXNzb2NpYXRlZCB0byBib3RoIGVkaXRkb2N1bWVudC5odG1sLnR3aWcgYW5kIGFkZGRvY3VtZW50Lmh0bWwudHdpZ1xyXG5cclxuY29uc3QgZmlsZVR5cGVJbnB1dCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdkb2N1bWVudF9mb3JtX3R5cGUnKTtcclxuICAgICAgICBjaGVja0ZpbGVUeXBlKCk7XHJcblxyXG4gICAgICAgIC8vIGNoZWNrcyB0aGUgY2hvc2VuIGZpbGUgdHlwZVxyXG5cclxuICAgICAgICBmdW5jdGlvbiBjaGVja0ZpbGVUeXBlKCkge1xyXG4gICAgICAgICAgICBjb25zdCB1cGxvYWRGaWxlSW5wdXQgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnZG9jdW1lbnRfZm9ybV9maWxlX3BhdGgnKTtcclxuICAgICAgICAgICAgY29uc3QgYWRkTGlua0lucHV0ID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2RvY3VtZW50X2Zvcm1fbGlua19wYXRoJyk7XHJcblxyXG4gICAgICAgICAgICBpZihmaWxlVHlwZUlucHV0LnZhbHVlID09PSAnbGllbicgfHwgZmlsZVR5cGVJbnB1dC52YWx1ZSA9PT0gJ3ZpZGVvJykge1xyXG4gICAgICAgICAgICAgICAgLy8gaWYgdXNlciBzZWxlY3RzIGxpbmsgb3IgdmlkZW8sIHRoZSBkaXNwbGF5ZWQgZmllbGQgaXMgYSB0ZXh0IHR5cGUgXHJcbiAgICAgICAgICAgICAgICB1cGxvYWRGaWxlSW5wdXQucGFyZW50RWxlbWVudC5jbGFzc0xpc3QuYWRkKCdkLW5vbmUnKTtcclxuICAgICAgICAgICAgICAgIGFkZExpbmtJbnB1dC5wYXJlbnRFbGVtZW50LmNsYXNzTGlzdC5yZW1vdmUoJ2Qtbm9uZScpO1xyXG5cclxuICAgICAgICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgICAgICAgIC8vIGluIHRoZSBjYXNlIG9mIG90aGVycyBkb2NzLCBhIGZpbGUgdHlwZSBmaWVsZCBhcHBlYXJzIHRvIHVwbG9hZCBhIGRvY3VtZW50IFxyXG4gICAgICAgICAgICAgICAgYWRkTGlua0lucHV0LnBhcmVudEVsZW1lbnQuY2xhc3NMaXN0LmFkZCgnZC1ub25lJyk7XHJcbiAgICAgICAgICAgICAgICB1cGxvYWRGaWxlSW5wdXQucGFyZW50RWxlbWVudC5jbGFzc0xpc3QucmVtb3ZlKCdkLW5vbmUnKTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgZmlsZVR5cGVJbnB1dC5hZGRFdmVudExpc3RlbmVyKCdjaGFuZ2UnLCAoKSA9PiB7XHJcbiAgICAgICAgICAgIGNoZWNrRmlsZVR5cGUoKTtcclxuICAgICAgICAgICAgXHJcbiAgICAgICAgfSlcclxuXHJcbi8vIGNvbmNlcm5pbmcgZWRpdGRvY3VtZW50Lmh0bWwudHdpZ1xyXG4vLyBzaG93cyBvciBoaWRlcyB0aGUgY2hhbmdlIG9mIGZpbGUgZGVwZW5kaW5nIG9uIHVzZXIncyBjaG9pY2VcclxuXHJcbmNvbnN0IGNoYW5nZURvY1NlbGVjdCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdkb2N1bWVudF9mb3JtX2NoYW5nZWRvYycpO1xyXG5jb25zdCBlZGl0RmlsZURpdiA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdlZGl0RmlsZScpO1xyXG5cclxuY2hhbmdlRG9jU2VsZWN0LmFkZEV2ZW50TGlzdGVuZXIoJ2NoYW5nZScsICgpID0+IHtcclxuICAgIGlmKGNoYW5nZURvY1NlbGVjdC52YWx1ZSA9PSAnY2hhbmdlRG9jWWVzJykge1xyXG4gICAgICAgIGVkaXRGaWxlRGl2LmNsYXNzTGlzdC5yZW1vdmUoJ2Qtbm9uZScpO1xyXG4gICAgfSBlbHNlIHtcclxuICAgICAgICBlZGl0RmlsZURpdi5jbGFzc0xpc3QuYWRkKCdkLW5vbmUnKTtcclxuICAgIH1cclxufSkiXSwibmFtZXMiOlsiZmlsZVR5cGVJbnB1dCIsImRvY3VtZW50IiwiZ2V0RWxlbWVudEJ5SWQiLCJjaGVja0ZpbGVUeXBlIiwidXBsb2FkRmlsZUlucHV0IiwiYWRkTGlua0lucHV0IiwidmFsdWUiLCJwYXJlbnRFbGVtZW50IiwiY2xhc3NMaXN0IiwiYWRkIiwicmVtb3ZlIiwiYWRkRXZlbnRMaXN0ZW5lciIsImNoYW5nZURvY1NlbGVjdCIsImVkaXRGaWxlRGl2Il0sInNvdXJjZVJvb3QiOiIifQ==