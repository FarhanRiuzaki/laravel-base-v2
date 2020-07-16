/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/custom.js":
/*!********************************!*\
  !*** ./resources/js/custom.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// ADMINART
// apps
$('.datepicker').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: 'true',
  orientation: 'bottom',
  todayHighlight: 'true'
}); // fill 15 char untuk no rek

function pad(str, max) {
  str = str.toString();
  return str.length < max ? pad("0" + str, max) : str;
} // validasi file upload


function fileCheck(file, size) {
  var file_type = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : [];
  file_name = file.files[0].name;
  size = file.files[0].size / 1024;
  limit = 1024 * size;
  validExtensions = file_type;
  extension = file_name.substr(file_name.lastIndexOf('.') + 1); // change_name = file_name.split('.').shift() + '' + parseInt(Math.random() * 10000) + '.' + extension;
  // file.name = change_name;

  valid = true;

  if (validExtensions.indexOf(extension) == -1) {
    swal.fire('Oops', 'file harus berektensi: ' + file_type, 'info');
    file.value = '';
  }

  if (size > limit) {
    swal.fire('Oops', 'file harus berukuran kurang dari 1MB', 'info');
    file.value = '';
  }
}

function number_format(nStr) {
  nStr += '';
  x = nStr.split('.');
  x1 = x[0];
  x2 = x.length > 1 ? '.' + x[1] : '';
  var rgx = /(\d+)(\d{3})/;

  while (rgx.test(x1)) {
    x1 = x1.replace(rgx, '$1' + ',' + '$2');
  }

  return x1 + x2;
} // deklarasi function


window.pad = pad;
window.fileCheck = fileCheck;
window.number_format = number_format; // COMPONENT

$('.number').number(true, 2); // $('.numberOnly').number(true);

$(".numberOnly").on("keypress keyup blur", function (event) {
  $(this).val($(this).val().replace(/[^\d].+/, ""));

  if (event.which < 48 || event.which > 57) {
    event.preventDefault();
  }
});
$('#detailList').on('shown.bs.collapse', function () {
  $(".iconDrop").addClass('fa-angle-up').removeClass('fa-angle-down');
});
$('#detailList').on('hidden.bs.collapse', function () {
  $(".iconDrop").addClass('fa-angle-down').removeClass('fa-angle-up');
});

/***/ }),

/***/ 1:
/*!**************************************!*\
  !*** multi ./resources/js/custom.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\laragon\www\trade-export\resources\js\custom.js */"./resources/js/custom.js");


/***/ })

/******/ });