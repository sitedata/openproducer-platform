!function(e){function t(t){for(var n,a,c=t[0],s=t[1],l=t[2],p=0,f=[];p<c.length;p++)a=c[p],Object.prototype.hasOwnProperty.call(i,a)&&i[a]&&f.push(i[a][0]),i[a]=0;for(n in s)Object.prototype.hasOwnProperty.call(s,n)&&(e[n]=s[n]);for(u&&u(t);f.length;)f.shift()();return o.push.apply(o,l||[]),r()}function r(){for(var e,t=0;t<o.length;t++){for(var r=o[t],n=!0,a=1;a<r.length;a++){var c=r[a];0!==i[c]&&(n=!1)}n&&(o.splice(t--,1),e=__webpack_require__(__webpack_require__.s=r[0]))}return e}var n={},i={18:0},o=[];function __webpack_require__(t){if(n[t])return n[t].exports;var r=n[t]={i:t,l:!1,exports:{}};return e[t].call(r.exports,r,r.exports,__webpack_require__),r.l=!0,r.exports}__webpack_require__.m=e,__webpack_require__.c=n,__webpack_require__.d=function(e,t,r){__webpack_require__.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},__webpack_require__.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},__webpack_require__.t=function(e,t){if(1&t&&(e=__webpack_require__(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(__webpack_require__.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var n in e)__webpack_require__.d(r,n,function(t){return e[t]}.bind(null,n));return r},__webpack_require__.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return __webpack_require__.d(t,"a",t),t},__webpack_require__.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},__webpack_require__.p="";var a=window.webpackJsonp=window.webpackJsonp||[],c=a.push.bind(a);a.push=t,a=a.slice();for(var s=0;s<a.length;s++)t(a[s]);var u=c;o.push([347,0]),r()}({188:function(e,t){e.exports=googlesitekit.api},237:function(e,t,r){"use strict";var n=r(74),i=r.n(n),o=r(63),a=r.n(o),c=r(262),s=r(11),u=r.n(s),l=r(20),p=r.n(l),f=r(13),v=r(188),_=r.n(v);function g(e,t){var r=Object.keys(e);return Object.getOwnPropertySymbols&&r.push.apply(r,Object.getOwnPropertySymbols(e)),t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r}function d(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?g(r,!0).forEach((function(t){p()(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):g(r).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}var S=a.a.commonActions,E=a.a.commonControls,y=a.a.createRegistrySelector,T=S.getRegistry,O=function(e,t,r){var n,o=arguments.length>3&&void 0!==arguments[3]?arguments[3]:{},a=o.storeName,c=void 0===a?void 0:a,s=o.settingSlugs,l=void 0===s?[]:s;i()(e,"type is required."),i()(t,"identifier is required."),i()(r,"datapoint is required.");var v=c||"".concat(e,"/").concat(t),g={settings:void 0,savedSettings:void 0,isFetchingSettings:!1,isFetchingSaveSettings:!1},O={},b=d({},S,{setSettings:function(e){return i()(e,"values is required."),{payload:{values:e},type:"SET_SETTINGS"}},fetchSettings:function(){return{payload:{},type:"FETCH_SETTINGS"}},receiveSettings:function(e){return i()(e,"values is required."),{payload:{values:e},type:"RECEIVE_SETTINGS"}},receiveSettingsFailed:function(){return{payload:{},type:"RECEIVE_SETTINGS_FAILED"}},saveSettings:u.a.mark((function e(){var t,r,n;return u.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,T();case 2:return t=e.sent,e.next=5,t.select(v).getSettings();case 5:return r=e.sent,e.prev=6,e.next=9,b.fetchSaveSettings(r);case 9:return n=e.sent,e.abrupt("return",b.receiveSaveSettings(n));case 13:return e.prev=13,e.t0=e.catch(6),e.abrupt("return",b.receiveSaveSettingsFailed());case 16:case"end":return e.stop()}}),e,null,[[6,13]])})),fetchSaveSettings:function(e){return i()(e,"values is required."),{payload:{values:e},type:"FETCH_SAVE_SETTINGS"}},receiveSaveSettings:function(e){return i()(e,"values is required."),{payload:{values:e},type:"RECEIVE_SAVE_SETTINGS"}},receiveSaveSettingsFailed:function(){return{payload:{},type:"RECEIVE_SAVE_SETTINGS_FAILED"}}}),I=d({},E,(n={},p()(n,"FETCH_SETTINGS",(function(){return _.a.get(e,t,r)})),p()(n,"FETCH_SAVE_SETTINGS",(function(n){var i=n.payload.values;return _.a.set(e,t,r,i)})),n)),N=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:g,t=arguments.length>1?arguments[1]:void 0,r=t.type,n=t.payload;switch(r){case"SET_SETTINGS":var i=n.values;return d({},e,{settings:d({},e.settings||{},{},i)});case"FETCH_SETTINGS":return d({},e,{isFetchingSettings:!0});case"RECEIVE_SETTINGS":var o=n.values;return d({},e,{isFetchingSettings:!1,savedSettings:d({},o),settings:d({},o,{},e.settings||{})});case"RECEIVE_SETTINGS_FAILED":return d({},e,{isFetchingSettings:!1});case"FETCH_SAVE_SETTINGS":return d({},e,{isFetchingSaveSettings:!0});case"RECEIVE_SAVE_SETTINGS":var a=n.values;return d({},e,{isFetchingSaveSettings:!1,savedSettings:d({},a),settings:d({},a)});case"RECEIVE_SAVE_SETTINGS_FAILED":return d({},e,{isFetchingSaveSettings:!1});default:return void 0!==O[r]?O[r](e,{type:r,payload:n}):d({},e)}},h={getSettings:u.a.mark((function e(){var t,r;return u.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,T();case 2:if(t=e.sent,!t.select(v).getSettings()){e.next=6;break}return e.abrupt("return");case 6:return e.prev=6,e.next=9,b.fetchSettings();case 9:return r=e.sent,e.abrupt("return",b.receiveSettings(r));case 13:return e.prev=13,e.t0=e.catch(6),e.abrupt("return",b.receiveSettingsFailed());case 16:case"end":return e.stop()}}),e,null,[[6,13]])}))},w={getSettings:function(e){return e.settings},haveSettingsChanged:function(e){var t=e.settings,r=e.savedSettings;return!Object(f.isEqual)(t,r)},isDoingSaveSettings:function(e){return e.isFetchingSaveSettings}};return l.forEach((function(e){var t=e.charAt(0).toUpperCase()+e.slice(1),r=e.replace(/([a-z0-9]{1})([A-Z]{1})/g,"$1_$2").toUpperCase();b["set".concat(t)]=function(e){return i()(e,"value is required."),{payload:{value:e},type:"SET_".concat(r)}},O["SET_".concat(r)]=function(t,r){var n=r.payload.value;return d({},t,{settings:d({},t.settings||{},p()({},e,n))})},w["get".concat(t)]=y((function(t){return function(){var r=t(v).getSettings();return void 0===r?r:r[e]}}))})),{STORE_NAME:v,INITIAL_STATE:g,actions:b,controls:I,reducer:N,resolvers:h,selectors:w}},b={createModuleStore:function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},r=t.storeName,n=void 0===r?void 0:r,o=t.settingSlugs,s=void 0===o?void 0:o;i()(e,"slug is required.");var u=Object(c.a)("modules",e,"notifications",{storeName:n}),l=[u.STORE_NAME],p=[u.INITIAL_STATE],f=[u.actions],v=[u.controls],_=[u.reducer],g=[u.resolvers],d=[u.selectors];if(void 0!==s){var S=O("modules",e,"settings",{storeName:n,settingSlugs:s});l.push(S.STORE_NAME),p.push(S.INITIAL_STATE),f.push(S.actions),v.push(S.controls),_.push(S.reducer),g.push(S.resolvers),d.push(S.selectors)}return{STORE_NAME:a.a.collectName.apply(a.a,l),INITIAL_STATE:a.a.collectState.apply(a.a,p),actions:a.a.collectActions.apply(a.a,f),controls:a.a.collectControls.apply(a.a,v),reducer:a.a.collectReducers.apply(a.a,_),resolvers:a.a.collectResolvers.apply(a.a,g),selectors:a.a.collectSelectors.apply(a.a,d)}}};t.a=b},262:function(e,t,r){"use strict";(function(e){r.d(t,"a",(function(){return v}));var n=r(11),i=r.n(n),o=r(20),a=r.n(o),c=r(74),s=r.n(c),u=r(188),l=r.n(u);function p(e,t){var r=Object.keys(e);return Object.getOwnPropertySymbols&&r.push.apply(r,Object.getOwnPropertySymbols(e)),t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r}function f(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?p(r,!0).forEach((function(t){a()(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):p(r).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}var v=function(t,r,n){var o=arguments.length>3&&void 0!==arguments[3]?arguments[3]:{},c=o.storeName,u=void 0===c?void 0:c;s()(t,"type is required."),s()(r,"identifier is required."),s()(n,"datapoint is required.");var p=u||"".concat(t,"/").concat(r),v={serverNotifications:void 0,clientNotifications:void 0,isFetchingNotifications:!1},_={addNotification:function(e){return s()(e,"notification is required."),{payload:{notification:e},type:"ADD_NOTIFICATION"}},removeNotification:function(e){return s()(e,"id is required."),{payload:{id:e},type:"REMOVE_NOTIFICATION"}},fetchNotifications:function(){return{payload:{},type:"FETCH_NOTIFICATIONS"}},receiveNotifications:function(e){return s()(e,"notifications is required."),{payload:{notifications:e},type:"RECEIVE_NOTIFICATIONS"}},receiveNotificationsFailed:function(){return{payload:{},type:"RECEIVE_NOTIFICATIONS_FAILED"}}},g=a()({},"FETCH_NOTIFICATIONS",(function(){return l.a.get(t,r,n)})),d=function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:v,r=arguments.length>1?arguments[1]:void 0,n=r.type,i=r.payload;switch(n){case"ADD_NOTIFICATION":var o=i.notification;return f({},t,{clientNotifications:f({},t.clientNotifications||{},a()({},o.id,o))});case"REMOVE_NOTIFICATION":var c=i.id;if(void 0===t.clientNotifications||void 0===t.clientNotifications[c])return void 0!==t.serverNotifications&&void 0!==t.serverNotifications[c]&&e.console.warn('Cannot remove server-side notification with ID "'.concat(c,'"; this may be changed in a future release.')),f({},t);var s=f({},t.clientNotifications);return delete s[c],f({},t,{clientNotifications:s});case"FETCH_NOTIFICATIONS":return f({},t,{isFetchingNotifications:!0});case"RECEIVE_NOTIFICATIONS":var u=i.notifications;return f({},t,{isFetchingNotifications:!1,serverNotifications:u.reduce((function(e,t){return f({},e,a()({},t.id,t))}),{})});case"RECEIVE_NOTIFICATIONS_FAILED":return f({},t,{isFetchingNotifications:!1});default:return f({},t)}},S={getNotifications:i.a.mark((function e(){var t;return i.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,_.fetchNotifications();case 3:return t=e.sent,e.abrupt("return",_.receiveNotifications(t));case 7:return e.prev=7,e.t0=e.catch(0),e.abrupt("return",_.receiveNotificationsFailed());case 10:case"end":return e.stop()}}),e,null,[[0,7]])}))},E={getNotifications:function(e){var t=e.serverNotifications,r=e.clientNotifications;return void 0===t&&void 0===r?t:Object.values(f({},t||{},{},r||{}))}};return{STORE_NAME:p,INITIAL_STATE:v,actions:_,controls:g,reducer:d,resolvers:S,selectors:E}}}).call(this,r(16))},347:function(e,t,r){"use strict";r.r(t),function(e){var n=r(20),i=r.n(n),o=r(237);function a(e,t){var r=Object.keys(e);return Object.getOwnPropertySymbols&&r.push.apply(r,Object.getOwnPropertySymbols(e)),t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r}void 0===e.googlesitekit&&(e.googlesitekit={}),void 0===e.googlesitekit.modules?e.googlesitekit.modules=o.a:e.googlesitekit.modules=function(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?a(r,!0).forEach((function(t){i()(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):a(r).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}({},e.googlesitekit.modules,{},o.a),t.default=o.a}.call(this,r(16))},63:function(e,t){e.exports=googlesitekit.data}});