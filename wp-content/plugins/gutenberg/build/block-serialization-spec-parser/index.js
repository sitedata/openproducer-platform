window.wp=window.wp||{},window.wp.blockSerializationSpecParser=function(t){var r={};function e(n){if(r[n])return r[n].exports;var o=r[n]={i:n,l:!1,exports:{}};return t[n].call(o.exports,o,o.exports,e),o.l=!0,o.exports}return e.m=t,e.c=r,e.d=function(t,r,n){e.o(t,r)||Object.defineProperty(t,r,{enumerable:!0,get:n})},e.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},e.t=function(t,r){if(1&r&&(t=e(t)),8&r)return t;if(4&r&&"object"==typeof t&&t&&t.__esModule)return t;var n=Object.create(null);if(e.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:t}),2&r&&"string"!=typeof t)for(var o in t)e.d(n,o,function(r){return t[r]}.bind(null,o));return n},e.n=function(t){var r=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(r,"a",r),r},e.o=function(t,r){return Object.prototype.hasOwnProperty.call(t,r)},e.p="",e(e.s=310)}({310:function(t,r,e){"use strict";function n(t,r,e,o){this.message=t,this.expected=r,this.found=e,this.location=o,this.name="SyntaxError","function"==typeof Error.captureStackTrace&&Error.captureStackTrace(this,n)}!function(t,r){function e(){this.constructor=t}e.prototype=r.prototype,t.prototype=new e}(n,Error),n.buildMessage=function(t,r){var e={literal:function(t){return'"'+o(t.text)+'"'},class:function(t){var r,e="";for(r=0;r<t.parts.length;r++)e+=t.parts[r]instanceof Array?u(t.parts[r][0])+"-"+u(t.parts[r][1]):u(t.parts[r]);return"["+(t.inverted?"^":"")+e+"]"},any:function(t){return"any character"},end:function(t){return"end of input"},other:function(t){return t.description}};function n(t){return t.charCodeAt(0).toString(16).toUpperCase()}function o(t){return t.replace(/\\/g,"\\\\").replace(/"/g,'\\"').replace(/\0/g,"\\0").replace(/\t/g,"\\t").replace(/\n/g,"\\n").replace(/\r/g,"\\r").replace(/[\x00-\x0F]/g,(function(t){return"\\x0"+n(t)})).replace(/[\x10-\x1F\x7F-\x9F]/g,(function(t){return"\\x"+n(t)}))}function u(t){return t.replace(/\\/g,"\\\\").replace(/\]/g,"\\]").replace(/\^/g,"\\^").replace(/-/g,"\\-").replace(/\0/g,"\\0").replace(/\t/g,"\\t").replace(/\n/g,"\\n").replace(/\r/g,"\\r").replace(/[\x00-\x0F]/g,(function(t){return"\\x0"+n(t)})).replace(/[\x10-\x1F\x7F-\x9F]/g,(function(t){return"\\x"+n(t)}))}return"Expected "+function(t){var r,n,o,u=new Array(t.length);for(r=0;r<t.length;r++)u[r]=(o=t[r],e[o.type](o));if(u.sort(),u.length>0){for(r=1,n=1;r<u.length;r++)u[r-1]!==u[r]&&(u[n]=u[r],n++);u.length=n}switch(u.length){case 1:return u[0];case 2:return u[0]+" or "+u[1];default:return u.slice(0,-1).join(", ")+", or "+u[u.length-1]}}(t)+" but "+function(t){return t?'"'+o(t)+'"':"end of input"}(r)+" found."},t.exports={SyntaxError:n,parse:function(t,r){r=void 0!==r?r:{};var e,o,u,c,i={},a={Block_List:R},s=R,l={type:"any"},f=function(t,r,e){return[r,e]},h=T("\x3c!--",!1),p=T("wp:",!1),g=function(t,r){return r},d=T("/--\x3e",!1),b=T("--\x3e",!1),x=T("/wp:",!1),v=T("/",!1),A=/^[a-z]/,y=P([["a","z"]],!1,!1),m=/^[a-z0-9_\-]/,w=P([["a","z"],["0","9"],"_","-"],!1,!1),C={type:"other",description:"JSON-encoded attributes embedded in a block's opening comment"},k=T("{",!1),S=T("}",!1),M=/^[ \t\r\n]/,O=P([" ","\t","\r","\n"],!1,!1),_=0,j=[{line:1,column:1}],F=0,N=[],E=0;if("startRule"in r){if(!(r.startRule in a))throw new Error("Can't start parsing from rule \""+r.startRule+'".');s=a[r.startRule]}function T(t,r){return{type:"literal",text:t,ignoreCase:r}}function P(t,r,e){return{type:"class",parts:t,inverted:r,ignoreCase:e}}function z(r){var e,n=j[r];if(n)return n;for(e=r-1;!j[e];)e--;for(n={line:(n=j[e]).line,column:n.column};e<r;)10===t.charCodeAt(e)?(n.line++,n.column=1):n.column++,e++;return j[r]=n,n}function B(t,r){var e=z(t),n=z(r);return{start:{offset:t,line:e.line,column:e.column},end:{offset:r,line:n.line,column:n.column}}}function L(t){_<F||(_>F&&(F=_,N=[]),N.push(t))}function R(){var r,e,n,o,u,c,a,s,h,p;for(r=_,e=_,n=[],o=_,u=_,E++,c=H(),E--,c===i?u=void 0:(_=u,u=i),u!==i?(t.length>_?(c=t.charAt(_),_++):(c=i,0===E&&L(l)),c!==i?o=u=[u,c]:(_=o,o=i)):(_=o,o=i);o!==i;)n.push(o),o=_,u=_,E++,c=H(),E--,c===i?u=void 0:(_=u,u=i),u!==i?(t.length>_?(c=t.charAt(_),_++):(c=i,0===E&&L(l)),c!==i?o=u=[u,c]:(_=o,o=i)):(_=o,o=i);if((e=n!==i?t.substring(e,_):n)!==i){if(n=[],o=_,(u=H())!==i){for(c=_,a=[],s=_,h=_,E++,p=H(),E--,p===i?h=void 0:(_=h,h=i),h!==i?(t.length>_?(p=t.charAt(_),_++):(p=i,0===E&&L(l)),p!==i?s=h=[h,p]:(_=s,s=i)):(_=s,s=i);s!==i;)a.push(s),s=_,h=_,E++,p=H(),E--,p===i?h=void 0:(_=h,h=i),h!==i?(t.length>_?(p=t.charAt(_),_++):(p=i,0===E&&L(l)),p!==i?s=h=[h,p]:(_=s,s=i)):(_=s,s=i);(c=a!==i?t.substring(c,_):a)!==i?o=u=f(0,u,c):(_=o,o=i)}else _=o,o=i;for(;o!==i;)if(n.push(o),o=_,(u=H())!==i){for(c=_,a=[],s=_,h=_,E++,p=H(),E--,p===i?h=void 0:(_=h,h=i),h!==i?(t.length>_?(p=t.charAt(_),_++):(p=i,0===E&&L(l)),p!==i?s=h=[h,p]:(_=s,s=i)):(_=s,s=i);s!==i;)a.push(s),s=_,h=_,E++,p=H(),E--,p===i?h=void 0:(_=h,h=i),h!==i?(t.length>_?(p=t.charAt(_),_++):(p=i,0===E&&L(l)),p!==i?s=h=[h,p]:(_=s,s=i)):(_=s,s=i);(c=a!==i?t.substring(c,_):a)!==i?o=u=f(0,u,c):(_=o,o=i)}else _=o,o=i;if(n!==i){for(o=_,u=[],t.length>_?(c=t.charAt(_),_++):(c=i,0===E&&L(l));c!==i;)u.push(c),t.length>_?(c=t.charAt(_),_++):(c=i,0===E&&L(l));(o=u!==i?t.substring(o,_):u)!==i?r=e=function(t,r,e){var n,o,u,c,i,a=[];for(t.length&&a.push(I(t)),n=0,o=r.length;n<o;n++)i=(c=r[n])[0],u=c[1],a.push(i),u.length&&a.push(I(u));return e.length&&a.push(I(e)),a}(e,n,o):(_=r,r=i)}else _=r,r=i}else _=r,r=i;return r}function H(){var r;return(r=function(){var r,e,n,o,u,c;return r=_,"\x3c!--"===t.substr(_,4)?(e="\x3c!--",_+=4):(e=i,0===E&&L(h)),e!==i&&G()!==i?("wp:"===t.substr(_,3)?(n="wp:",_+=3):(n=i,0===E&&L(p)),n!==i&&(o=U())!==i&&G()!==i?(u=_,(c=D())!==i&&G()!==i?u=c=g(0,c):(_=u,u=i),u===i&&(u=null),u!==i?("/--\x3e"===t.substr(_,4)?(c="/--\x3e",_+=4):(c=i,0===E&&L(d)),c!==i?r=e={blockName:o,attrs:u||{},innerBlocks:[],innerHTML:"",innerContent:[]}:(_=r,r=i)):(_=r,r=i)):(_=r,r=i)):(_=r,r=i),r}())===i&&(r=function(){var r,e,n,o,u,c,a,s,f,d,x,v,A,y;if(r=_,(e=function(){var r,e,n,o,u,c;return r=_,"\x3c!--"===t.substr(_,4)?(e="\x3c!--",_+=4):(e=i,0===E&&L(h)),e!==i&&G()!==i?("wp:"===t.substr(_,3)?(n="wp:",_+=3):(n=i,0===E&&L(p)),n!==i&&(o=U())!==i&&G()!==i?(u=_,(c=D())!==i&&G()!==i?u=c=g(0,c):(_=u,u=i),u===i&&(u=null),u!==i?("--\x3e"===t.substr(_,3)?(c="--\x3e",_+=3):(c=i,0===E&&L(b)),c!==i?r=e={blockName:o,attrs:u||{}}:(_=r,r=i)):(_=r,r=i)):(_=r,r=i)):(_=r,r=i),r}())!==i){if(n=[],(o=H())===i){if(o=_,u=[],c=_,a=_,E++,s=H(),E--,s===i?a=void 0:(_=a,a=i),a!==i?(s=_,E++,f=J(),E--,f===i?s=void 0:(_=s,s=i),s!==i?(t.length>_?(f=t.charAt(_),_++):(f=i,0===E&&L(l)),f!==i?c=a=[a,s,f]:(_=c,c=i)):(_=c,c=i)):(_=c,c=i),c!==i)for(;c!==i;)u.push(c),c=_,a=_,E++,s=H(),E--,s===i?a=void 0:(_=a,a=i),a!==i?(s=_,E++,f=J(),E--,f===i?s=void 0:(_=s,s=i),s!==i?(t.length>_?(f=t.charAt(_),_++):(f=i,0===E&&L(l)),f!==i?c=a=[a,s,f]:(_=c,c=i)):(_=c,c=i)):(_=c,c=i);else u=i;o=u!==i?t.substring(o,_):u}for(;o!==i;)if(n.push(o),(o=H())===i){if(o=_,u=[],c=_,a=_,E++,s=H(),E--,s===i?a=void 0:(_=a,a=i),a!==i?(s=_,E++,f=J(),E--,f===i?s=void 0:(_=s,s=i),s!==i?(t.length>_?(f=t.charAt(_),_++):(f=i,0===E&&L(l)),f!==i?c=a=[a,s,f]:(_=c,c=i)):(_=c,c=i)):(_=c,c=i),c!==i)for(;c!==i;)u.push(c),c=_,a=_,E++,s=H(),E--,s===i?a=void 0:(_=a,a=i),a!==i?(s=_,E++,f=J(),E--,f===i?s=void 0:(_=s,s=i),s!==i?(t.length>_?(f=t.charAt(_),_++):(f=i,0===E&&L(l)),f!==i?c=a=[a,s,f]:(_=c,c=i)):(_=c,c=i)):(_=c,c=i);else u=i;o=u!==i?t.substring(o,_):u}n!==i&&(o=J())!==i?(d=e,v=(x=function(t){var r,e,n,o="",u=[],c=[];for(r=0,e=t.length;r<e;r++)"string"==typeof(n=t[r])?(o+=n,c.push(n)):(u.push(n),c.push(null));return[o,u,c]}(n))[0],A=x[1],y=x[2],r=e={blockName:d.blockName,attrs:d.attrs,innerBlocks:A,innerHTML:v,innerContent:y}):(_=r,r=i)}else _=r,r=i;return r}()),r}function J(){var r,e,n,o,u;return r=_,"\x3c!--"===t.substr(_,4)?(e="\x3c!--",_+=4):(e=i,0===E&&L(h)),e!==i&&G()!==i?("/wp:"===t.substr(_,4)?(n="/wp:",_+=4):(n=i,0===E&&L(x)),n!==i&&(o=U())!==i&&G()!==i?("--\x3e"===t.substr(_,3)?(u="--\x3e",_+=3):(u=i,0===E&&L(b)),u!==i?r=e={blockName:o}:(_=r,r=i)):(_=r,r=i)):(_=r,r=i),r}function U(){var r,e,n;return(r=function(){var r,e,n,o,u;return r=_,e=_,(n=q())!==i?(47===t.charCodeAt(_)?(o="/",_++):(o=i,0===E&&L(v)),o!==i&&(u=q())!==i?e=n=[n,o,u]:(_=e,e=i)):(_=e,e=i),r=e!==i?t.substring(r,_):e}())===i&&(e=_,(e=(n=q())!==i?t.substring(e,_):n)!==i&&(e="core/"+e),r=e),r}function q(){var r,e,n,o,u;if(r=_,e=_,A.test(t.charAt(_))?(n=t.charAt(_),_++):(n=i,0===E&&L(y)),n!==i){for(o=[],m.test(t.charAt(_))?(u=t.charAt(_),_++):(u=i,0===E&&L(w));u!==i;)o.push(u),m.test(t.charAt(_))?(u=t.charAt(_),_++):(u=i,0===E&&L(w));o!==i?e=n=[n,o]:(_=e,e=i)}else _=e,e=i;return e!==i?t.substring(r,_):e}function D(){var r,e,n,o,u,c,a,s,f,h,p,g,d;if(E++,r=_,e=_,n=_,123===t.charCodeAt(_)?(o="{",_++):(o=i,0===E&&L(k)),o!==i){for(u=[],c=_,a=_,E++,s=_,125===t.charCodeAt(_)?(f="}",_++):(f=i,0===E&&L(S)),f!==i&&(h=G())!==i&&(p="")!==i?(47===t.charCodeAt(_)?(g="/",_++):(g=i,0===E&&L(v)),g===i&&(g=null),g!==i?("--\x3e"===t.substr(_,3)?(d="--\x3e",_+=3):(d=i,0===E&&L(b)),d!==i?s=f=[f,h,p,g,d]:(_=s,s=i)):(_=s,s=i)):(_=s,s=i),E--,s===i?a=void 0:(_=a,a=i),a!==i?(t.length>_?(s=t.charAt(_),_++):(s=i,0===E&&L(l)),s!==i?c=a=[a,s]:(_=c,c=i)):(_=c,c=i);c!==i;)u.push(c),c=_,a=_,E++,s=_,125===t.charCodeAt(_)?(f="}",_++):(f=i,0===E&&L(S)),f!==i&&(h=G())!==i&&(p="")!==i?(47===t.charCodeAt(_)?(g="/",_++):(g=i,0===E&&L(v)),g===i&&(g=null),g!==i?("--\x3e"===t.substr(_,3)?(d="--\x3e",_+=3):(d=i,0===E&&L(b)),d!==i?s=f=[f,h,p,g,d]:(_=s,s=i)):(_=s,s=i)):(_=s,s=i),E--,s===i?a=void 0:(_=a,a=i),a!==i?(t.length>_?(s=t.charAt(_),_++):(s=i,0===E&&L(l)),s!==i?c=a=[a,s]:(_=c,c=i)):(_=c,c=i);u!==i?(125===t.charCodeAt(_)?(c="}",_++):(c=i,0===E&&L(S)),c!==i?n=o=[o,u,c]:(_=n,n=i)):(_=n,n=i)}else _=n,n=i;return(e=n!==i?t.substring(e,_):n)!==i&&(e=function(t){try{return JSON.parse(t)}catch(t){return null}}(e)),E--,(r=e)===i&&(e=i,0===E&&L(C)),r}function G(){var r,e;if(r=[],M.test(t.charAt(_))?(e=t.charAt(_),_++):(e=i,0===E&&L(O)),e!==i)for(;e!==i;)r.push(e),M.test(t.charAt(_))?(e=t.charAt(_),_++):(e=i,0===E&&L(O));else r=i;return r}function I(t){return t.length&&{blockName:null,attrs:{},innerBlocks:[],innerHTML:t,innerContent:[t]}}if((e=s())!==i&&_===t.length)return e;throw e!==i&&_<t.length&&L({type:"end"}),o=N,u=F<t.length?t.charAt(F):null,c=F<t.length?B(F,F+1):B(F,F),new n(n.buildMessage(o,u),o,u,c)}}}});