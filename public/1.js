webpackJsonp([1],{

/***/ 56:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(68)
}
var normalizeComponent = __webpack_require__(11)
/* script */
var __vue_script__ = __webpack_require__(70)
/* template */
var __vue_template__ = __webpack_require__(71)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources\\assets\\js\\components\\debate.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-944e7ef0", Component.options)
  } else {
    hotAPI.reload("data-v-944e7ef0", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 58:
/***/ (function(module, exports, __webpack_require__) {

/*
  MIT License http://www.opensource.org/licenses/mit-license.php
  Author Tobias Koppers @sokra
  Modified by Evan You @yyx990803
*/

var hasDocument = typeof document !== 'undefined'

if (typeof DEBUG !== 'undefined' && DEBUG) {
  if (!hasDocument) {
    throw new Error(
    'vue-style-loader cannot be used in a non-browser environment. ' +
    "Use { target: 'node' } in your Webpack config to indicate a server-rendering environment."
  ) }
}

var listToStyles = __webpack_require__(59)

/*
type StyleObject = {
  id: number;
  parts: Array<StyleObjectPart>
}

type StyleObjectPart = {
  css: string;
  media: string;
  sourceMap: ?string
}
*/

var stylesInDom = {/*
  [id: number]: {
    id: number,
    refs: number,
    parts: Array<(obj?: StyleObjectPart) => void>
  }
*/}

var head = hasDocument && (document.head || document.getElementsByTagName('head')[0])
var singletonElement = null
var singletonCounter = 0
var isProduction = false
var noop = function () {}
var options = null
var ssrIdKey = 'data-vue-ssr-id'

// Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
// tags it will allow on a page
var isOldIE = typeof navigator !== 'undefined' && /msie [6-9]\b/.test(navigator.userAgent.toLowerCase())

module.exports = function (parentId, list, _isProduction, _options) {
  isProduction = _isProduction

  options = _options || {}

  var styles = listToStyles(parentId, list)
  addStylesToDom(styles)

  return function update (newList) {
    var mayRemove = []
    for (var i = 0; i < styles.length; i++) {
      var item = styles[i]
      var domStyle = stylesInDom[item.id]
      domStyle.refs--
      mayRemove.push(domStyle)
    }
    if (newList) {
      styles = listToStyles(parentId, newList)
      addStylesToDom(styles)
    } else {
      styles = []
    }
    for (var i = 0; i < mayRemove.length; i++) {
      var domStyle = mayRemove[i]
      if (domStyle.refs === 0) {
        for (var j = 0; j < domStyle.parts.length; j++) {
          domStyle.parts[j]()
        }
        delete stylesInDom[domStyle.id]
      }
    }
  }
}

function addStylesToDom (styles /* Array<StyleObject> */) {
  for (var i = 0; i < styles.length; i++) {
    var item = styles[i]
    var domStyle = stylesInDom[item.id]
    if (domStyle) {
      domStyle.refs++
      for (var j = 0; j < domStyle.parts.length; j++) {
        domStyle.parts[j](item.parts[j])
      }
      for (; j < item.parts.length; j++) {
        domStyle.parts.push(addStyle(item.parts[j]))
      }
      if (domStyle.parts.length > item.parts.length) {
        domStyle.parts.length = item.parts.length
      }
    } else {
      var parts = []
      for (var j = 0; j < item.parts.length; j++) {
        parts.push(addStyle(item.parts[j]))
      }
      stylesInDom[item.id] = { id: item.id, refs: 1, parts: parts }
    }
  }
}

function createStyleElement () {
  var styleElement = document.createElement('style')
  styleElement.type = 'text/css'
  head.appendChild(styleElement)
  return styleElement
}

function addStyle (obj /* StyleObjectPart */) {
  var update, remove
  var styleElement = document.querySelector('style[' + ssrIdKey + '~="' + obj.id + '"]')

  if (styleElement) {
    if (isProduction) {
      // has SSR styles and in production mode.
      // simply do nothing.
      return noop
    } else {
      // has SSR styles but in dev mode.
      // for some reason Chrome can't handle source map in server-rendered
      // style tags - source maps in <style> only works if the style tag is
      // created and inserted dynamically. So we remove the server rendered
      // styles and inject new ones.
      styleElement.parentNode.removeChild(styleElement)
    }
  }

  if (isOldIE) {
    // use singleton mode for IE9.
    var styleIndex = singletonCounter++
    styleElement = singletonElement || (singletonElement = createStyleElement())
    update = applyToSingletonTag.bind(null, styleElement, styleIndex, false)
    remove = applyToSingletonTag.bind(null, styleElement, styleIndex, true)
  } else {
    // use multi-style-tag mode in all other cases
    styleElement = createStyleElement()
    update = applyToTag.bind(null, styleElement)
    remove = function () {
      styleElement.parentNode.removeChild(styleElement)
    }
  }

  update(obj)

  return function updateStyle (newObj /* StyleObjectPart */) {
    if (newObj) {
      if (newObj.css === obj.css &&
          newObj.media === obj.media &&
          newObj.sourceMap === obj.sourceMap) {
        return
      }
      update(obj = newObj)
    } else {
      remove()
    }
  }
}

var replaceText = (function () {
  var textStore = []

  return function (index, replacement) {
    textStore[index] = replacement
    return textStore.filter(Boolean).join('\n')
  }
})()

function applyToSingletonTag (styleElement, index, remove, obj) {
  var css = remove ? '' : obj.css

  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = replaceText(index, css)
  } else {
    var cssNode = document.createTextNode(css)
    var childNodes = styleElement.childNodes
    if (childNodes[index]) styleElement.removeChild(childNodes[index])
    if (childNodes.length) {
      styleElement.insertBefore(cssNode, childNodes[index])
    } else {
      styleElement.appendChild(cssNode)
    }
  }
}

function applyToTag (styleElement, obj) {
  var css = obj.css
  var media = obj.media
  var sourceMap = obj.sourceMap

  if (media) {
    styleElement.setAttribute('media', media)
  }
  if (options.ssrId) {
    styleElement.setAttribute(ssrIdKey, obj.id)
  }

  if (sourceMap) {
    // https://developer.chrome.com/devtools/docs/javascript-debugging
    // this makes source maps inside style tags work properly in Chrome
    css += '\n/*# sourceURL=' + sourceMap.sources[0] + ' */'
    // http://stackoverflow.com/a/26603875
    css += '\n/*# sourceMappingURL=data:application/json;base64,' + btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))) + ' */'
  }

  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = css
  } else {
    while (styleElement.firstChild) {
      styleElement.removeChild(styleElement.firstChild)
    }
    styleElement.appendChild(document.createTextNode(css))
  }
}


/***/ }),

/***/ 59:
/***/ (function(module, exports) {

/**
 * Translates the list format produced by css-loader into something
 * easier to manipulate.
 */
module.exports = function listToStyles (parentId, list) {
  var styles = []
  var newStyles = {}
  for (var i = 0; i < list.length; i++) {
    var item = list[i]
    var id = item[0]
    var css = item[1]
    var media = item[2]
    var sourceMap = item[3]
    var part = {
      id: parentId + ':' + i,
      css: css,
      media: media,
      sourceMap: sourceMap
    }
    if (!newStyles[id]) {
      styles.push(newStyles[id] = { id: id, parts: [part] })
    } else {
      newStyles[id].parts.push(part)
    }
  }
  return styles
}


/***/ }),

/***/ 68:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(69);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(58)("6f13409a", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-944e7ef0\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./debate.vue", function() {
     var newContent = require("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-944e7ef0\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./debate.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 69:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(12)(false);
// imports


// module
exports.push([module.i, "\nlabel {\n    display:inline!important;\n    font-weight:100;\n}\n.mt-progress-runway {\n    background-color: red !important;\n    border-radius: 4px !important;\n}\n.box {\n    display: -webkit-box;\n    display: -ms-flexbox;\n    display: flex;\n    display: -webkit-flex; /* Safari */\n    -webkit-box-orient:horizontal;\n    -webkit-box-direction:normal;\n        -ms-flex-direction:row;\n            flex-direction:row;\n    -webkit-box-pack:justify;\n        -ms-flex-pack:justify;\n            justify-content:space-between;\n    -webkit-box-align:center;\n        -ms-flex-align:center;\n            align-items:center;\n}\n.pk {\n    \n    width: 100%;\n    /* height: 3em; */\n    /* flex-grow:1; */\n    margin-top: 10%;\n    margin-bottom: 2%;\n}\n.left, .right  {\n    /* width: 30%; */\n    text-align: center;\n    font-size: 25px;\n    -webkit-box-flex:2;\n        -ms-flex-positive:2;\n            flex-grow:2;\n}\n.block_button .mint-button {\n    height: 60px!important;\n}\n.pk_text {\n    -webkit-box-flex:1;\n        -ms-flex-positive:1;\n            flex-grow:1;\n    font-size: 30px;\n    text-align: center;\n}\n.mint-header-title {\n    overflow: visible !important;\n}\n.block_button {\n    margin-top: 15%;\n}\n.mint-button {\n    width: 35% !important;\n}\n.message {\n    margin-top: 20%;\n    width: 100%;\n    height: 12em;\n    /* background: red; */\n}\n.form {\n    margin-top: 15%;\n    display: -webkit-box;\n    display: -ms-flexbox;\n    display: flex;\n    bottom: 0;\n}\n.input {\n     -webkit-box-flex:6;\n         -ms-flex-positive:6;\n             flex-grow:6;\n}\n.button {\n    -webkit-box-flex:1;\n        -ms-flex-positive:1;\n            flex-grow:1;\n}\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 70:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_mint_ui__ = __webpack_require__(13);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_mint_ui___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_mint_ui__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//


/* harmony default export */ __webpack_exports__["default"] = ({
    data: function data() {
        return {
            messageData: [],
            returnDta: [],
            ID: 0
        };
    },

    methods: {
        getData: function getData() {
            var _this = this;
            axios.get('/debate/getOption', {
                params: {
                    opinion_id: _this.ID
                }
            }).then(function (response) {
                if (response.data.code == 0) {
                    console.log(response.data.result);
                    _this.ID = response.data.result[response.data.result.length - 1].id;
                    _this.messageData.concat(response.data.result);
                }
            });
        },


        // setTimingData() {
        //     let _this = this;
        //     // var getdata = this.getData
        //
        //     setInterval(() => {
        //         // let _this = this;
        //         axios.get('/debate/getOption',{
        //             params: {
        //                 opinion_id : _this.ID
        //             }
        //         })
        //         .then((response)=> {
        //             if(response.data.code == 0) {
        //                 // console.log(response.data.result[response.data.result.length -1].id);
        //                 // console.log(_this.ID);
        //                 _this.ID = parseInt(response.data.result[response.data.result.length -1].id);
        //                 // _this.test(parseInt(response.data.result[response.data.result.length -1].id));
        //                 _this.messageData.concat(response.data.result);
        //             }
        //         });
        //     },2000);
        // },
        getLiDom: function getLiDom(item) {
            var styles = [{ class: 'label label-primary', text: '未选择' }, { class: 'label label-primary', text: '正方' }, { class: 'label label-danger', text: '反方' }];
            var li = document.createElement("li");
            var span1 = document.createElement("span");
            var span2 = document.createElement("span");
            //0没有选择，1正，2反
            li.setAttribute('class', 'list-group-item');
            span1.setAttribute('class', styles[item.stand].class);
            span1.innerHTML = styles[item.stand].text;
            span2.innerHTML = item.name + ': ' + item.context;

            li.appendChild(span1);
            li.appendChild(span2);

            return li;
        },
        setLiDom: function setLiDom(index) {
            var ul = document.getElementById('ul_message');
            var liArr = ul.children;
            var _this = this;
            if (liArr.length >= 1) ul.removeChild(liArr[0]);
            if (index == 0) this.returnDta.forEach(function (item, index) {
                ul.appendChild(_this.getLiDom(item));
            });else ul.appendChild(this.getLiDom(this.returnDta[this.returnDta.length - 1]));
        },
        setTimingDom: function setTimingDom() {
            var _this = this;
            var index = 0;
            var length = 4;
            setInterval(function () {
                if (_this.messageData.length < 5) _this.returnDta = _this.messageData;else {
                    _this.returnDta = _this.messageData.slice(index, index + legth);
                }
                _this.setLiDom(index);
                ++index;
            }, 1500);
        }
    },
    mounted: function mounted() {
        // this.getData();
        // this.setTimingData();
        // this.setTimingDom();
    }
});

/***/ }),

/***/ 71:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "content fix" },
    [
      _c("mt-header", { attrs: { title: "固定在顶部" } }),
      _vm._v(" "),
      _vm._m(0),
      _vm._v(" "),
      _vm._m(1),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "block_button box" },
        [
          _c("mt-button", { attrs: { size: "normal", type: "primary" } }, [
            _vm._v("支持正方")
          ]),
          _vm._v(" "),
          _c("mt-button", { attrs: { size: "normal", type: "danger" } }, [
            _vm._v("支持反方")
          ])
        ],
        1
      ),
      _vm._v(" "),
      _vm._m(2),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "form" },
        [
          _c("input", {
            staticClass: "input",
            attrs: { type: "text", placeholder: "Username" }
          }),
          _vm._v(" "),
          _c(
            "mt-button",
            {
              staticClass: "button",
              attrs: { size: "normal", type: "danger" }
            },
            [_vm._v("发送")]
          )
        ],
        1
      )
    ],
    1
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "pk box" }, [
      _c("div", { staticClass: "left" }, [_vm._v("正方：50人")]),
      _vm._v(" "),
      _c("div", { staticClass: "pk_text" }, [_vm._v("PK")]),
      _vm._v(" "),
      _c("div", { staticClass: "right" }, [_vm._v("反方：50人")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "progress" }, [
      _c(
        "div",
        {
          staticClass: "progress-bar progress-bar-striped active",
          staticStyle: { width: "50%" },
          attrs: {
            role: "progressbar",
            "aria-valuenow": "45",
            "aria-valuemin": "0",
            "aria-valuemax": "100"
          }
        },
        [_c("span", { staticClass: "sr-only" }, [_vm._v("45% Complete")])]
      ),
      _vm._v(" "),
      _c(
        "div",
        {
          staticClass:
            "progress-bar progress-bar-striped progress-bar-success active right_color",
          staticStyle: { width: "50%" },
          attrs: {
            role: "progressbar",
            "aria-valuenow": "45",
            "aria-valuemin": "0",
            "aria-valuemax": "100"
          }
        },
        [_c("span", { staticClass: "sr-only" }, [_vm._v("45% Complete")])]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "message" }, [
      _c("ul", { staticClass: "list-group", attrs: { id: "ul_message" } })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-944e7ef0", module.exports)
  }
}

/***/ })

});