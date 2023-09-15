<script setup lang="ts">
// Animations
onMounted(() => {
    !function(t, e){ 'object'==typeof exports&&'undefined'!=typeof module?module.exports=e():'function'==typeof __SVGATOR_DEFINE__&&__SVGATOR_DEFINE__.amd?__SVGATOR_DEFINE__(e):((t='undefined'!=typeof globalThis?globalThis:t||self).__SVGATOR_PLAYER__=t.__SVGATOR_PLAYER__||{}, t.__SVGATOR_PLAYER__['91c80d77']=e()) }(this, (() =>{
        'use strict';function t(t, e){ const n=Object.keys(t);if (Object.getOwnPropertySymbols){ let r=Object.getOwnPropertySymbols(t);e&&(r=r.filter(((e) =>{ return Object.getOwnPropertyDescriptor(t, e).enumerable }))), n.push.apply(n, r) } return n } function e(e){ for (let n=1;n<arguments.length;n++){ var r=null!=arguments[n]?arguments[n]:{};n%2?t(Object(r), !0).forEach(((t) =>{ u(e, t, r[t]) })):Object.getOwnPropertyDescriptors?Object.defineProperties(e, Object.getOwnPropertyDescriptors(r)):t(Object(r)).forEach(((t) =>{ Object.defineProperty(e, t, Object.getOwnPropertyDescriptor(r, t)) })) } return e } function n(t){ return (n='function'==typeof Symbol&&'symbol'==typeof Symbol.iterator?function(t){ return typeof t }:function(t){ return t&&'function'==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?'symbol':typeof t })(t) } function r(t, e){ if (!(t instanceof e)) throw new TypeError('Cannot call a class as a function') } function i(t, e){ for (let n=0;n<e.length;n++){ const r=e[n];r.enumerable=r.enumerable||!1, r.configurable=!0, 'value'in r&&(r.writable=!0), Object.defineProperty(t, r.key, r) } } function o(t, e, n){ return e&&i(t.prototype, e), n&&i(t, n), t } function u(t, e, n){ return e in t?Object.defineProperty(t, e, { value: n, enumerable: !0, configurable: !0, writable: !0 }):t[e]=n, t } function a(t){ return (a=Object.setPrototypeOf?Object.getPrototypeOf:function(t){ return t.__proto__||Object.getPrototypeOf(t) })(t) } function l(t, e){ return (l=Object.setPrototypeOf||function(t, e){ return t.__proto__=e, t })(t, e) } function s(){
            if ('undefined'==typeof Reflect||!Reflect.construct) return !1;if (Reflect.construct.sham) return !1;if ('function'==typeof Proxy) return !0;try { return Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], (() =>{}))), !0 }
            catch (t){ return !1 }
        } function f(t, e, n){ return (f=s()?Reflect.construct:function(t, e, n){ const r=[null];r.push.apply(r, e);const i=new(Function.bind.apply(t, r));return n&&l(i, n.prototype), i }).apply(null, arguments) } function c(t, e){ if (e&&('object'==typeof e||'function'==typeof e)) return e;if (void 0!==e) throw new TypeError('Derived constructors may only return object or undefined');return function(t){ if (void 0===t) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return t }(t) } function h(t, e, n){ return (h='undefined'!=typeof Reflect&&Reflect.get?Reflect.get:function(t, e, n){ const r=function(t, e){ for (;!Object.prototype.hasOwnProperty.call(t, e)&&null!==(t=a(t)););return t }(t, e);if (r){ const i=Object.getOwnPropertyDescriptor(r, e);return i.get?i.get.call(n):i.value } })(t, e, n||t) } function v(t){ return function(t){ if (Array.isArray(t)) return d(t) }(t)||function(t){ if ('undefined'!=typeof Symbol&&null!=t[Symbol.iterator]||null!=t['@@iterator']) return Array.from(t) }(t)||function(t, e){ if (!t) return;if ('string'==typeof t) return d(t, e);let n=Object.prototype.toString.call(t).slice(8, -1);'Object'===n&&t.constructor&&(n=t.constructor.name);if ('Map'===n||'Set'===n) return Array.from(t);if ('Arguments'===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return d(t, e) }(t)||function(){ throw new TypeError('Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.') }() } function d(t, e){ (null==e||e>t.length)&&(e=t.length);for (var n=0, r=new Array(e);n<e;n++)r[n]=t[n];return r } function y(t, e, n){ if (Number.isInteger(t)) return t;const r=Math.pow(10, e);return Math[n]((+t+Number.EPSILON)*r)/r }Number.isInteger||(Number.isInteger=function(t){ return 'number'==typeof t&&isFinite(t)&&Math.floor(t)===t }), Number.EPSILON||(Number.EPSILON=2220446049250313e-31);const g=p(Math.pow(10, -6));function p(t){ const e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:6;return y(t, e, 'round') } function m(t, e){ const n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:g;return Math.abs(t-e)<n }p(Math.pow(10, -2)), p(Math.pow(10, -4));const b=Math.PI/180;function w(t){ return t } function k(t, e, n){ const r=1-n;return 3*n*r*(t*r+e*n)+n*n*n } function _(){ const t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:0, e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:0, n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:1, r=arguments.length>3&&void 0!==arguments[3]?arguments[3]:1;return t<0||t>1||n<0||n>1?null:m(t, e)&&m(n, r)?w:function(i){ if (i<=0) return t>0?i*e/t:0===e&&n>0?i*r/n:0;if (i>=1) return n<1?1+(i-1)*(r-1)/(n-1):1===n&&t<1?1+(i-1)*(e-1)/(t-1):1;for (var o, u=0, a=1;u<a;){ const l=k(t, n, o=(u+a)/2);if (m(i, l)) break;l<i?u=o:a=o } return k(e, r, o) } } function A(){ return 1 } function x(t){ return 1===t?1:0 } function O(){ const t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:1, e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:0;if (1===t){ if (0===e) return x;if (1===e) return A } const n=1/t;return function(t){ return t>=1?1:(t+=e*n)-t%n } } const S=Math.sin, E=Math.cos, j=Math.acos, M=Math.asin, P=Math.tan, B=Math.atan2, I=Math.PI/180, T=180/Math.PI, N=Math.sqrt, R=function(){ function t(){ const e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:1, n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:0, i=arguments.length>2&&void 0!==arguments[2]?arguments[2]:0, o=arguments.length>3&&void 0!==arguments[3]?arguments[3]:1, u=arguments.length>4&&void 0!==arguments[4]?arguments[4]:0, a=arguments.length>5&&void 0!==arguments[5]?arguments[5]:0;r(this, t), this.m=[e, n, i, o, u, a], this.i=null, this.w=null, this.s=null } return o(t, [{ key: 'determinant', get(){ const t=this.m;return t[0]*t[3]-t[1]*t[2] } }, { key: 'isIdentity', get(){ if (null===this.i){ const t=this.m;this.i=1===t[0]&&0===t[1]&&0===t[2]&&1===t[3]&&0===t[4]&&0===t[5] } return this.i } }, { key: 'point', value(t, e){ const n=this.m;return { x: n[0]*t+n[2]*e+n[4], y: n[1]*t+n[3]*e+n[5] } } }, { key: 'translateSelf', value(){ const t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:0, e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:0;if (!t&&!e) return this;const n=this.m;return n[4]+=n[0]*t+n[2]*e, n[5]+=n[1]*t+n[3]*e, this.w=this.s=this.i=null, this } }, { key: 'rotateSelf', value(){ let t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:0;if (t%=360){ const e=S(t*=I), n=E(t), r=this.m, i=r[0], o=r[1];r[0]=i*n+r[2]*e, r[1]=o*n+r[3]*e, r[2]=r[2]*n-i*e, r[3]=r[3]*n-o*e, this.w=this.s=this.i=null } return this } }, { key: 'scaleSelf', value(){ const t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:1, e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:1;if (1!==t||1!==e){ const n=this.m;n[0]*=t, n[1]*=t, n[2]*=e, n[3]*=e, this.w=this.s=this.i=null } return this } }, { key: 'skewSelf', value(t, e){ if (e%=360, (t%=360)||e){ const n=this.m, r=n[0], i=n[1], o=n[2], u=n[3];t&&(t=P(t*I), n[2]+=r*t, n[3]+=i*t), e&&(e=P(e*I), n[0]+=o*e, n[1]+=u*e), this.w=this.s=this.i=null } return this } }, { key: 'resetSelf', value(){ const t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:1, e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:0, n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:0, r=arguments.length>3&&void 0!==arguments[3]?arguments[3]:1, i=arguments.length>4&&void 0!==arguments[4]?arguments[4]:0, o=arguments.length>5&&void 0!==arguments[5]?arguments[5]:0, u=this.m;return u[0]=t, u[1]=e, u[2]=n, u[3]=r, u[4]=i, u[5]=o, this.w=this.s=this.i=null, this } }, { key: 'recomposeSelf', value(){ const t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null, e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null, n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:null, r=arguments.length>3&&void 0!==arguments[3]?arguments[3]:null, i=arguments.length>4&&void 0!==arguments[4]?arguments[4]:null;return this.isIdentity||this.resetSelf(), t&&(t.x||t.y)&&this.translateSelf(t.x, t.y), e&&this.rotateSelf(e), n&&(n.x&&this.skewSelf(n.x, 0), n.y&&this.skewSelf(0, n.y)), !r||1===r.x&&1===r.y||this.scaleSelf(r.x, r.y), i&&(i.x||i.y)&&this.translateSelf(i.x, i.y), this } }, { key: 'decompose', value(){ let t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:0, e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:0, n=this.m, r=n[0]*n[0]+n[1]*n[1], i=[[n[0], n[1]], [n[2], n[3]]], o=N(r);if (0===o) return { origin: { x: p(n[4]), y: p(n[5]) }, translate: { x: p(t), y: p(e) }, scale: { x: 0, y: 0 }, skew: { x: 0, y: 0 }, rotate: 0 };i[0][0]/=o, i[0][1]/=o;const u=n[0]*n[3]-n[1]*n[2]<0;u&&(o=-o);let a=i[0][0]*i[1][0]+i[0][1]*i[1][1];i[1][0]-=i[0][0]*a, i[1][1]-=i[0][1]*a;const l=N(i[1][0]*i[1][0]+i[1][1]*i[1][1]);if (0===l) return { origin: { x: p(n[4]), y: p(n[5]) }, translate: { x: p(t), y: p(e) }, scale: { x: p(o), y: 0 }, skew: { x: 0, y: 0 }, rotate: 0 };i[1][0]/=l, i[1][1]/=l, a/=l;let s=0;return i[1][1]<0?(s=j(i[1][1])*T, i[0][1]<0&&(s=360-s)):s=M(i[0][1])*T, u&&(s=-s), a=B(a, N(i[0][0]*i[0][0]+i[0][1]*i[0][1]))*T, u&&(a=-a), { origin: { x: p(n[4]), y: p(n[5]) }, translate: { x: p(t), y: p(e) }, scale: { x: p(o), y: p(l) }, skew: { x: p(a), y: 0 }, rotate: p(s) } } }, { key: 'clone', value(){ const t=this.m;return new this.constructor(t[0], t[1], t[2], t[3], t[4], t[5]) } }, { key: 'toString', value(){ const t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:' ';if (null===this.s){ const e=this.m.map(((t) =>{ return p(t) }));1===e[0]&&0===e[1]&&0===e[2]&&1===e[3]?this.s=`translate(${e[4]}${t}${e[5]})`:this.s=`matrix(${e.join(t)})` } return this.s } }], [{ key: 'create', value(t){ return t?Array.isArray(t)?f(this, v(t)):t instanceof this?t.clone():(new this).recomposeSelf(t.origin, t.rotate, t.skew, t.scale, t.translate):new this } }]), t }();function F(t, e, n){ return t>=.5?n:e } function D(t, e, n){ return 0===t||e===n?e:t*(n-e)+e } function C(t, e, n){ const r=D(t, e, n);return r<=0?0:r } function q(t, e, n){ const r=D(t, e, n);return r<=0?0:r>=1?1:r } function L(t, e, n){ return 0===t?e:1===t?n:{ x: D(t, e.x, n.x), y: D(t, e.y, n.y) } } function V(t, e, n){ return 0===t?e:1===t?n:{ x: C(t, e.x, n.x), y: C(t, e.y, n.y) } } function G(t, e, n){ const r=function(t, e, n){ return Math.round(D(t, e, n)) }(t, e, n);return r<=0?0:r>=255?255:r } function z(t, e, n){ return 0===t?e:1===t?n:{ r: G(t, e.r, n.r), g: G(t, e.g, n.g), b: G(t, e.b, n.b), a: D(t, null==e.a?1:e.a, null==n.a?1:n.a) } } function Y(t, e, n){ const r=e.length;if (r!==n.length) return F(t, e, n);for (var i=new Array(r), o=0;o<r;o++)i[o]=D(t, e[o], n[o]);return i } function U(t, e){ for (var n=[], r=0;r<t;r++)n.push(e);return n } function W(t, e){ if (--e<=0) return t;const n=(t=Object.assign([], t)).length;do { for (let r=0;r<n;r++)t.push(t[r]) } while (--e>0);return t } let $, H=function(){ function t(e){ r(this, t), this.list=e, this.length=e.length } return o(t, [{ key: 'setAttribute', value(t, e){ for (let n=this.list, r=0;r<this.length;r++)n[r].setAttribute(t, e) } }, { key: 'removeAttribute', value(t){ for (let e=this.list, n=0;n<this.length;n++)e[n].removeAttribute(t) } }, { key: 'style', value(t, e){ for (let n=this.list, r=0;r<this.length;r++)n[r].style[t]=e } }]), t }(), Q=/-./g, X=function(t, e){ return e.toUpperCase() };function J(t){ return 'function'==typeof t?t:F } function K(t){ return t?'function'==typeof t?t:Array.isArray(t)?function(t){ const e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:w;if (!Array.isArray(t)) return e;switch (t.length){ case 1:return O(t[0])||e;case 2:return O(t[0], t[1])||e;case 4:return _(t[0], t[1], t[2], t[3])||e } return e }(t, null):function(t, e){ const n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:w;switch (t){ case 'linear':return w;case 'steps':return O(e.steps||1, e.jump||0)||n;case 'bezier':case 'cubic-bezier':return _(e.x1||0, e.y1||0, e.x2||0, e.y2||0)||n } return n }(t.type, t.value, null):null } function Z(t, e, n){ const r=arguments.length>3&&void 0!==arguments[3]&&arguments[3], i=e.length-1;if (t<=e[0].t) return r?[0, 0, e[0].v]:e[0].v;if (t>=e[i].t) return r?[i, 1, e[i].v]:e[i].v;let o, u=e[0], a=null;for (o=1;o<=i;o++){ if (!(t>e[o].t)){ a=e[o];break }u=e[o] } return null==a?r?[i, 1, e[i].v]:e[i].v:u.t===a.t?r?[o, 1, a.v]:a.v:(t=(t-u.t)/(a.t-u.t), u.e&&(t=u.e(t)), r?[o, t, n(t, u.v, a.v)]:n(t, u.v, a.v)) } function tt(t, e){ let n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:null;return t&&t.length?'function'!=typeof e?null:('function'!=typeof n&&(n=null), function(r){ let i=Z(r, t, e);return null!=i&&n&&(i=n(i)), i }):null } function et(t, e){ return t.t-e.t } function nt(t, e, r, i, o){ let u, a='@'===r[0], l='#'===r[0], s=$[r], f=F;switch (a?(u=r.substr(1), r=u.replace(Q, X)):l&&(r=r.substr(1)), n(s)){ case 'function':if (f=s(i, o, Z, K, r, a, e, t), l) return f;break;case 'string':f=tt(i, J(s));break;case 'object':if ((f=tt(i, J(s.i), s.f))&&'function'==typeof s.u) return s.u(e, f, r, a, t) } return f?function(t, e, n){ if (arguments.length>3&&void 0!==arguments[3]&&arguments[3]) return t instanceof H?function(r){ return t.style(e, n(r)) }:function(r){ return t.style[e]=n(r) };if (Array.isArray(e)){ const r=e.length;return function(i){ const o=n(i);if (null==o) for (let u=0;u<r;u++)t[u].removeAttribute(e);else for (let a=0;a<r;a++)t[a].setAttribute(e, o) } } return function(r){ const i=n(r);null==i?t.removeAttribute(e):t.setAttribute(e, i) } }(e, r, f, a):null } function rt(t, e, r, i){ if (!i||'object'!==n(i)) return null;let o=null, u=null;return Array.isArray(i)?u=function(t){ if (!t||!t.length) return null;for (let e=0;e<t.length;e++)t[e].e&&(t[e].e=K(t[e].e));return t.sort(et) }(i):(u=i.keys, o=i.data||null), u?nt(t, e, r, u, o):null } function it(t, e, n){ if (!n) return null;const r=[];for (const i in n) if (n.hasOwnProperty(i)){ const o=rt(t, e, i, n[i]);o&&r.push(o) } return r.length?r:null } function ot(t, e){
            if (!e.settings.duration||e.settings.duration<0) return null;let n, r, i, o, u, a=function(t, e){
                if (!e) return null;let n=[];if (Array.isArray(e)) {
                    for (let r=e.length, i=0;i<r;i++){
                        const o=e[i];if (2===o.length){
                            let u=null;if ('string'==typeof o[0]){ u=t.getElementById(o[0]) }
                            else if (Array.isArray(o[0])){ u=[];for (let a=0;a<o[0].length;a++) if ('string'==typeof o[0][a]){ const l=t.getElementById(o[0][a]);l&&u.push(l) }u=u.length?1===u.length?u[0]:new H(u):null } if (u){ const s=it(t, u, o[1]);s&&(n=n.concat(s)) }
                        }
                    }
                }
                else { for (const f in e) if (e.hasOwnProperty(f)){ const c=t.getElementById(f);if (c){ const h=it(t, c, e[f]);h&&(n=n.concat(h)) } } } return n.length?n:null
            }(t, e.elements);return a?(n=a, r=e.settings, i=r.duration, o=n.length, u=null, function(t, e){ let a=r.iterations||1/0, l=(r.alternate&&a%2==0)^r.direction>0?i:0, s=t%i, f=1+(t-s)/i;e*=r.direction, r.alternate&&f%2==0&&(e=-e);let c=!1;if (f>a)s=l, c=!0, -1===r.fill&&(s=r.direction>0?0:i);else if (e<0&&(s=i-s), s===u) return !1;u=s;for (let h=0;h<o;h++)n[h](s);return c }):null
        } function ut(t, e){ for (let n=e.querySelectorAll('svg'), r=0;r<n.length;r++) if (n[r].id===t.root&&!n[r].svgatorAnimation) return n[r].svgatorAnimation=!0, n[r];return null } function at(t){ const e=function(t){ return t.shadowRoot };return document?Array.from(t.querySelectorAll(`:not(${['a', 'area', 'audio', 'br', 'canvas', 'circle', 'datalist', 'embed', 'g', 'head', 'hr', 'iframe', 'img', 'input', 'link', 'object', 'path', 'polygon', 'rect', 'script', 'source', 'style', 'svg', 'title', 'track', 'video'].join()})`)).filter(e).map(e):[] } function lt(t){ const e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:document, n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:0, r=ut(t, e);if (r) return r;if (n>=20) return null;for (let i=at(e), o=0;o<i.length;o++){ const u=lt(t, i[o], n+1);if (u) return u } return null } function st(t, e){ if ($=e, !t||!t.root||!Array.isArray(t.animations)) return null;const n=lt(t);if (!n) return null;const r=t.animations.map(((t) =>{ return ot(n, t) })).filter(((t) =>{ return !!t }));return r.length?{ svg: n, animations: r, animationSettings: t.animationSettings, options: t.options||void 0 }:null } function ft(t){ const e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null, n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:Number, r=arguments.length>3&&void 0!==arguments[3]?arguments[3]:'undefined'!=typeof BigInt&&BigInt, i=`0x${t.replace(/[^0-9a-fA-F]+/g, '')||27}`;return e&&r&&n.isSafeInteger&&!n.isSafeInteger(+i)?n(r(i))%e+e:+i } function ct(t, e, n){ return !t||!n||e>t.length?t:t.substring(0, e)+ct(t.substring(e+1), n, n) } function ht(t){ const e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:27;return !t||t%e?t%e:[0, 1].includes(e)?e:ht(t/e, e) } function vt(t, e, n){
            if (t&&t.length){
                let r=ft(n), i=ht(r)+5, o=ct(t, ht(r, 5), i);return o=o.replace(/\x7C$/g, '==').replace(/\x2F$/g, '='), o=function(t, e, n){
                    const r=+(`0x${t.substring(0, 4)}`);t=t.substring(4);for (var i=ft(e, r)%r+n%27, o=[], u=0;u<t.length;u+=2) {
                        if ('|'!==t[u]){ const a=+(`0x${t[u]}${t[u+1]}`)-i;o.push(a) }
                        else { const l=+(`0x${t.substring(u+1, u+1+4)}`)-i;u+=3, o.push(l) }
                    } return String.fromCharCode.apply(String, o)
                }(o=(o=atob(o)).replace(/[\x41-\x5A]/g, ''), e, r), o=JSON.parse(o)
            }
        } const dt=[{ key: 'alternate', def: !1 }, { key: 'fill', def: 1 }, { key: 'iterations', def: 0 }, { key: 'direction', def: 1 }, { key: 'speed', def: 1 }, { key: 'fps', def: 100 }], yt=function(){ function t(e, n){ const i=this, o=arguments.length>2&&void 0!==arguments[2]?arguments[2]:null;r(this, t), this._id=0, this._running=!1, this._rollingBack=!1, this._animations=e, this._settings=n, (!o||o<'2022-05-02')&&delete this._settings.speed, dt.forEach(((t) =>{ i._settings[t.key]=i._settings[t.key]||t.def })), this.duration=n.duration, this.offset=n.offset||0, this.rollbackStartOffset=0 } return o(t, [{ key: 'alternate', get(){ return this._settings.alternate } }, { key: 'fill', get(){ return this._settings.fill } }, { key: 'iterations', get(){ return this._settings.iterations } }, { key: 'direction', get(){ return this._settings.direction } }, { key: 'speed', get(){ return this._settings.speed } }, { key: 'fps', get(){ return this._settings.fps } }, { key: 'maxFiniteDuration', get(){ return this.iterations>0?this.iterations*this.duration:this.duration } }, { key: '_apply', value(t){ for (var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{}, n=this._animations, r=n.length, i=0, o=0;o<r;o++)e[o]?i++:(e[o]=n[o](t, 1), e[o]&&i++);return i } }, { key: '_rollback', value(t){ let e=this, n=1/0, r=null;this.rollbackStartOffset=t, this._rollingBack=!0, this._running=!0;this._id=window.requestAnimationFrame((function i(o){ if (e._rollingBack){ null==r&&(r=o);let u=Math.round(t-(o-r)*e.speed);if (u>e.duration&&n!==1/0){ let a=!!e.alternate&&u/e.duration%2>1, l=u%e.duration;u=(l+=a?e.duration:0)||e.duration } const s=(e.fps?1e3/e.fps:0)*e.speed, f=Math.max(0, u);f<=n-s&&(e.offset=f, n=f, e._apply(f));const c=e.iterations>0&&-1===e.fill&&u>=e.maxFiniteDuration;(u<=0||e.offset<u||c)&&e.stop(), e._id=window.requestAnimationFrame(i) } })) } }, { key: '_start', value(){ let t=this, e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:0, n=-1/0, r=null, i={};this._running=!0;const o=function o(u){ null==r&&(r=u);const a=Math.round((u-r)*t.speed+e), l=(t.fps?1e3/t.fps:0)*t.speed;if (a>=n+l&&!t._rollingBack&&(t.offset=a, n=a, t._apply(a, i)===t._animations.length)) return void t.pause(!0);t._id=window.requestAnimationFrame(o) };this._id=window.requestAnimationFrame(o) } }, { key: '_pause', value(){ this._id&&window.cancelAnimationFrame(this._id), this._running=!1 } }, { key: 'play', value(){ if (!this._running) return this._rollingBack?this._rollback(this.offset):this._start(this.offset) } }, { key: 'stop', value(){ this._pause(), this.offset=0, this.rollbackStartOffset=0, this._rollingBack=!1, this._apply(0) } }, { key: 'reachedToEnd', value(){ return this.iterations>0&&this.offset>=this.iterations*this.duration } }, { key: 'restart', value(){ const t=arguments.length>0&&void 0!==arguments[0]&&arguments[0];this.stop(t), this.play(t) } }, { key: 'pause', value(){ this._pause() } }, { key: 'reverse', value(){ this.direction=-this.direction } }], [{ key: 'build', value(t, e){ delete t.animationSettings, t.options=vt(t.options, t.root, '91c80d77'), t.animations.map(((e) =>{ e.settings=vt(e.s, t.root, '91c80d77'), delete e.s, t.animationSettings||(t.animationSettings=e.settings) }));const n=t.version;if (!(t=st(t, e))) return null;const r=t.options||{}, i=new this(t.animations, t.animationSettings, n);return { el: t.svg, options: r, player: i } } }, { key: 'push', value(t){ return this.build(t) } }, { key: 'init', value(){ const t=this, e=window.__SVGATOR_PLAYER__&&window.__SVGATOR_PLAYER__['91c80d77'];Array.isArray(e)&&e.splice(0).forEach(((e) =>{ return t.build(e) })) } }]), t }();!function(){ for (var t=0, e=['ms', 'moz', 'webkit', 'o'], n=0;n<e.length&&!window.requestAnimationFrame;++n)window.requestAnimationFrame=window[`${e[n]}RequestAnimationFrame`], window.cancelAnimationFrame=window[`${e[n]}CancelAnimationFrame`]||window[`${e[n]}CancelRequestAnimationFrame`];window.requestAnimationFrame||(window.requestAnimationFrame=function(e){ const n=Date.now(), r=Math.max(0, 16-(n-t)), i=window.setTimeout((() =>{ e(n+r) }), r);return t=n+r, i }, window.cancelAnimationFrame=window.clearTimeout) }();const gt=function(){
            function t(e, n, i){
                r(this, t);const o=function(t){
                    let e, n, r, i=t&&1===(null===(e=t.ownerDocument)||void 0===e||null===(n=e.childNodes)||void 0===n?void 0:n.length)&&window.parent!==window, o={ el: t, window };if (!i) return o;try { r=window.parent.document }
                    catch (t){ return o } return o.window=window.parent, o.el=Array.from(r.querySelectorAll('iframe,object')).filter(((t) =>{ return t.contentWindow===window }))[0]||o.el, o
                }(e);n=Math.max(1, n||1), n=Math.min(n, 100), this.el=o.el, this._handlers=[], this.onThresholdChange=i&&i.call?i:function(){}, this.thresholdPercent=n||1, this.currentVisibility=null, this.visibilityCalculator=function(t, e){ var n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:n, r=!1, i=null, o=function(){ for (var o=0, u=n.innerHeight, a=0, l=n.innerWidth, s=t.parentNode;s instanceof Element;){ const f=n.getComputedStyle(s);if ('visible'!==f.overflowY||'visible'!==f.overflowX){ const c=s.getBoundingClientRect();'visible'!==f.overflowY&&(o=Math.max(o, c.top), u=Math.min(u, c.bottom)), 'visible'!==f.overflowX&&(a=Math.max(a, c.left), l=Math.min(l, c.right)) } if (s===s.parentNode) break;s=s.parentNode }r=!1;const h=t.getBoundingClientRect(), v=Math.min(h.height, Math.max(0, o-h.top)), d=Math.min(h.height, Math.max(0, h.bottom-u)), y=Math.min(h.width, Math.max(0, a-h.left)), g=Math.min(h.width, Math.max(0, h.right-l)), p=(h.height-v-d)/h.height, m=(h.width-y-g)/h.width, b=Math.round(p*m*100);null!==i&&i===b||(i=b, e(b)) };return function(t){ r&&clearTimeout(r), r=setTimeout((() =>{ return o() }), 100) } }(this.el, this.onVisibilityUpdate.bind(this), o.window), this.bindScrollWatchers(), this.visibilityCalculator()
            } return o(t, [{ key: 'bindScrollWatchers', value(){ for (let t=this.el.parentNode;t&&(this._handlers.push({ element: t, event: 'scroll', handler: this.visibilityCalculator }), t.addEventListener('scroll', this.visibilityCalculator), t!==t.parentNode&&t!==document);)t=t.parentNode } }, { key: 'onVisibilityUpdate', value(t){ const e=this.currentVisibility>=this.thresholdPercent, n=t>=this.thresholdPercent;if (null===this.currentVisibility||e!==n) return this.currentVisibility=t, void this.onThresholdChange(n);this.currentVisibility=t } }, { key: 'destruct', value(){ this._handlers.forEach(((t) =>{ t.element.removeEventListener(t.event, t.handler) })) } }]), t
        }();function pt(t){ return `${p(t)}` } function mt(t){ const e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:' ';return t&&t.length?t.map(pt).join(e):'' } function bt(t){ return `${pt(t.x)},${pt(t.y)}` } function wt(t){ if (!t) return 'transparent';if (null==t.a||t.a>=1){ let e=function(t){ return 1===(t=parseInt(t).toString(16)).length?`0${t}`:t }, n=function(t){ return t.charAt(0)===t.charAt(1) }, r=e(t.r), i=e(t.g), o=e(t.b);return n(r)&&n(i)&&n(o)&&(r=r.charAt(0), i=i.charAt(0), o=o.charAt(0)), `#${r}${i}${o}` } return `rgba(${t.r},${t.g},${t.b},${t.a})` } function kt(t){ return t?`url(#${t})`:'none' } const _t={ f: null, i: V, u(t, e){ return function(n){ const r=e(n);t.setAttribute('rx', pt(r.x)), t.setAttribute('ry', pt(r.y)) } } }, At={ f: null, i(t, e, n){ return 0===t?e:1===t?n:{ width: C(t, e.width, n.width), height: C(t, e.height, n.height) } }, u(t, e){ return function(n){ const r=e(n);t.setAttribute('width', pt(r.width)), t.setAttribute('height', pt(r.height)) } } };Object.freeze({ M: 2, L: 2, Z: 0, H: 1, V: 1, C: 6, Q: 4, T: 2, S: 4, A: 7 });let xt={}, Ot=null;function St(t){ const e=function(){ if (Ot) return Ot;if ('object'!==('undefined'==typeof document?'undefined':n(document))||!document.createElementNS) return {};const t=document.createElementNS('http://www.w3.org/2000/svg', 'svg');return t&&t.style?(t.style.position='absolute', t.style.opacity='0.01', t.style.zIndex='-9999', t.style.left='-9999px', t.style.width='1px', t.style.height='1px', Ot={ svg: t }):{} }().svg;if (!e) return function(t){ return null };const r=document.createElementNS(e.namespaceURI, 'path');r.setAttributeNS(null, 'd', t), r.setAttributeNS(null, 'fill', 'none'), r.setAttributeNS(null, 'stroke', 'none'), e.appendChild(r);const i=r.getTotalLength();return function(t){ const e=r.getPointAtLength(i*t);return { x: e.x, y: e.y } } } function Et(t){ return xt[t]?xt[t]:xt[t]=St(t) } function jt(t, e, n, r){ if (!t||!r) return !1;const i=['M', t.x, t.y];if (e&&n&&(i.push('C'), i.push(e.x), i.push(e.y), i.push(n.x), i.push(n.y)), e?!n:n){ const o=e||n;i.push('Q'), i.push(o.x), i.push(o.y) } return e||n||i.push('L'), i.push(r.x), i.push(r.y), i.join(' ') } function Mt(t, e, n, r){
            const i=arguments.length>4&&void 0!==arguments[4]?arguments[4]:1, o=jt(t, e, n, r), u=Et(o);try { return u(i) }
            catch (t){ return null }
        } function Pt(t, e, n){ return t+(e-t)*n } function Bt(t, e, n){ const r=arguments.length>3&&void 0!==arguments[3]&&arguments[3], i={ x: Pt(t.x, e.x, n), y: Pt(t.y, e.y, n) };return r&&(i.a=It(t, e)), i } function It(t, e){ return Math.atan2(e.y-t.y, e.x-t.x) } function Tt(t, e, n, r){ const i=1-r;return i*i*t+2*i*r*e+r*r*n } function Nt(t, e, n, r){ return 2*(1-r)*(e-t)+2*r*(n-e) } function Rt(t, e, n, r){ let i=arguments.length>4&&void 0!==arguments[4]&&arguments[4], o=Mt(t, e, null, n, r);return o||(o={ x: Tt(t.x, e.x, n.x, r), y: Tt(t.y, e.y, n.y, r) }), i&&(o.a=Ft(t, e, n, r)), o } function Ft(t, e, n, r){ return Math.atan2(Nt(t.y, e.y, n.y, r), Nt(t.x, e.x, n.x, r)) } function Dt(t, e, n, r, i){ const o=i*i;return i*o*(r-t+3*(e-n))+3*o*(t+n-2*e)+3*i*(e-t)+t } function Ct(t, e, n, r, i){ const o=1-i;return 3*(o*o*(e-t)+2*o*i*(n-e)+i*i*(r-n)) } function qt(t, e, n, r, i){ let o=arguments.length>5&&void 0!==arguments[5]&&arguments[5], u=Mt(t, e, n, r, i);return u||(u={ x: Dt(t.x, e.x, n.x, r.x, i), y: Dt(t.y, e.y, n.y, r.y, i) }), o&&(u.a=Lt(t, e, n, r, i)), u } function Lt(t, e, n, r, i){ return Math.atan2(Ct(t.y, e.y, n.y, r.y, i), Ct(t.x, e.x, n.x, r.x, i)) } function Vt(t, e, n){
            const r=arguments.length>3&&void 0!==arguments[3]&&arguments[3];if (zt(e)){ if (Yt(n)) return Rt(e, n.start, n, t, r) }
            else if (zt(n)){ if (Ut(e)) return Rt(e, e.end, n, t, r) }
            else { if (Ut(e)) return Yt(n)?qt(e, e.end, n.start, n, t, r):Rt(e, e.end, n, t, r);if (Yt(n)) return Rt(e, n.start, n, t, r) } return Bt(e, n, t, r)
        } function Gt(t, e, n){ const r=Vt(t, e, n, !0);return r.a=function(t){ return arguments.length>1&&void 0!==arguments[1]&&arguments[1]?t+Math.PI:t }(r.a)/b, r } function zt(t){ return !t.type||'corner'===t.type } function Yt(t){ return null!=t.start&&!zt(t) } function Ut(t){ return null!=t.end&&!zt(t) } const Wt=new R;const $t={ f(t){ return t?t.join(' '):'' }, i(t, e, r){
                if (0===t) return e;if (1===t) return r;const i=e.length;if (i!==r.length) return F(t, e, r);for (var o, u=new Array(i), a=0;a<i;a++){
                    if ((o=n(e[a]))!==n(r[a])) return F(t, e, r);if ('number'===o){ u[a]=D(t, e[a], r[a]) }
                    else { if (e[a]!==r[a]) return F(t, e, r);u[a]=e[a] }
                } return u
            } }, Ht={ f: null, i: Y, u(t, e){ return function(n){ const r=e(n);t.setAttribute('x1', pt(r[0])), t.setAttribute('y1', pt(r[1])), t.setAttribute('x2', pt(r[2])), t.setAttribute('y2', pt(r[3])) } } }, Qt={ f: pt, i: D }, Xt={ f: pt, i: q }, Jt={ f(t){ const e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:' ';return t&&t.length>0&&(t=t.map(((t) =>{ return p(t, 4) }))), mt(t, e) }, i(t, e, n){
                let r, i, o, u=e.length, a=n.length;if (u!==a) {
                    if (0===u){ e=U(u=a, 0) }
                    else if (0===a){ a=u, n=U(u, 0) }
                    else { const l=(o=(r=u)*(i=a)/function(t, e){ for (var n;e;)n=e, e=t%e, t=n;return t||1 }(r, i))<0?-o:o;e=W(e, Math.floor(l/u)), n=W(n, Math.floor(l/a)), u=a=l }
                } for (var s=[], f=0;f<u;f++)s.push(p(C(t, e[f], n[f])));return s
            } };function Kt(t, e, n){ return t.map(((t) =>{ return function(t, e, n){ const r=t.v;if (!r||'g'!==r.t||r.s||!r.v||!r.r) return t;const i=n.getElementById(r.r), o=i&&i.querySelectorAll('stop')||[];return r.s=r.v.map(((t, e) =>{ let n=o[e]&&o[e].getAttribute('offset');return { c: t, o: n=p(parseInt(n)/100) } })), delete r.v, t }(t, 0, n) })) } const Zt={ gt: 'gradientTransform', c: { x: 'cx', y: 'cy' }, rd: 'r', f: { x: 'x1', y: 'y1' }, to: { x: 'x2', y: 'y2' } };function te(t, e, r, i, o, u, a, l){
            return Kt(t, 0, l), e=function(t, e, n){ for (var r, i, o, u=t.length-1, a={}, l=0;l<=u;l++)(r=t[l]).e&&(r.e=e(r.e)), r.v&&'g'===(i=r.v).t&&i.r&&(o=n.getElementById(i.r))&&(a[i.r]={ e: o, s: o.querySelectorAll('stop') });return a }(t, i, l), function(i){
                const o=r(i, t, ee);if (!o) return 'none';if ('c'===o.t) return wt(o.v);if ('g'===o.t){
                    if (!e[o.r]) return kt(o.r);const u=e[o.r];return function(t, e){ for (var n=t.s, r=n.length;r<e.length;r++){ const i=n[n.length-1].cloneNode();i.id=ie(i.id), t.e.appendChild(i), n=t.s=t.e.querySelectorAll('stop') } for (let o=0, u=n.length, a=e.length-1;o<u;o++)n[o].setAttribute('stop-color', wt(e[Math.min(o, a)].c)), n[o].setAttribute('offset', e[Math.min(o, a)].o) }(u, o.s), Object.keys(Zt).forEach(((t) =>{
                        if (void 0!==o[t]) {
                            if ('object'!==n(Zt[t])){ let e, r='gt'===t?(e=o[t], Array.isArray(e)?`matrix(${e.join(' ')})`:''):o[t], i=Zt[t];u.e.setAttribute(i, r) }
                            else { Object.keys(Zt[t]).forEach(((e) =>{ if (void 0!==o[t][e]){ const n=o[t][e], r=Zt[t][e];u.e.setAttribute(r, n) } })) }
                        }
                    })), kt(o.r)
                } return 'none'
            }
        } function ee(t, n, r){ if (0===t) return n;if (1===t) return r;if (n&&r){ const i=n.t;if (i===r.t) switch (n.t){ case 'c':return { t: i, v: z(t, n.v, r.v) };case 'g':if (n.r===r.r){ const o={ t: i, s: ne(t, n.s, r.s), r: n.r };return n.gt&&r.gt&&(o.gt=Y(t, n.gt, r.gt)), n.c?(o.c=L(t, n.c, r.c), o.rd=C(t, n.rd, r.rd)):n.f&&(o.f=L(t, n.f, r.f), o.to=L(t, n.to, r.to)), o } } if ('c'===n.t&&'g'===r.t||'c'===r.t&&'g'===n.t){ const u='c'===n.t?n:r, a='g'===n.t?e({}, n):e({}, r), l=a.s.map(((t) =>{ return { c: u.v, o: t.o } }));return a.s='c'===n.t?ne(t, l, a.s):ne(t, a.s, l), a } } return F(t, n, r) } function ne(t, e, n){ if (e.length===n.length) return e.map(((e, r) =>{ return re(t, e, n[r]) }));for (var r=Math.max(e.length, n.length), i=[], o=0;o<r;o++){ const u=re(t, e[Math.min(o, e.length-1)], n[Math.min(o, n.length-1)]);i.push(u) } return i } function re(t, e, n){ return { o: q(t, e.o, n.o||0), c: z(t, e.c, n.c||{}) } } function ie(t){ return t.replace(/-fill-([0-9]+)$/, ((t, e) =>{ return `-fill-${+e+1}` })) } function oe(t, e, n){ return 0===t?e:1===t?n:{ blur: V(t, e.blur, n.blur), offset: L(t, e.offset, n.offset), color: z(t, e.color, n.color) } } const ue={ 'blur': V, 'brightness': C, 'contrast': C, 'drop-shadow': oe, 'inner-shadow': oe, 'grayscale': C, 'hue-rotate': D, 'invert': C, 'opacity': C, 'saturate': C, 'sepia': C };function ae(t, e, n){ if (0===t) return e;if (1===t) return n;const r=e.length;if (r!==n.length) return F(t, e, n);for (var i, o=[], u=0;u<r;u++){ if (e[u].type!==n[u].type) return e;if (!(i=ue[e[u].type])) return F(t, e, n);o.push({ type: e.type, value: i(t, e[u].value, n[u].value) }) } return o } const le={ 'blur': function(t){ return t?function(e){ t.setAttribute('stdDeviation', bt(e)) }:null }, 'brightness': function(t, e, n){ return (t=fe(n, e))?function(e){ e=pt(e), t.map(((t) =>{ return t.setAttribute('slope', e) })) }:null }, 'contrast': function(t, e, n){ return (t=fe(n, e))?function(e){ const n=pt((1-e)/2);e=pt(e), t.map(((t) =>{ t.setAttribute('slope', e), t.setAttribute('intercept', n) })) }:null }, 'drop-shadow': function(t, e, n){ const r=n.getElementById(`${e}-blur`);if (!r) return null;const i=n.getElementById(`${e}-offset`);if (!i) return null;const o=n.getElementById(`${e}-flood`);return o?function(t){ r.setAttribute('stdDeviation', bt(t.blur)), i.setAttribute('dx', pt(t.offset.x)), i.setAttribute('dy', pt(t.offset.y)), o.setAttribute('flood-color', wt(t.color)) }:null }, 'inner-shadow': function(t, e, n){ const r=n.getElementById(`${e}-blur`);if (!r) return null;const i=n.getElementById(`${e}-offset`);if (!i) return null;const o=n.getElementById(`${e}-color-matrix`);return o?function(t){ r.setAttribute('stdDeviation', bt(t.blur)), i.setAttribute('dx', pt(t.offset.x)), i.setAttribute('dy', pt(t.offset.y));const e=[0, 0, 0, 0, t.color.r/255, 0, 0, 0, 0, t.color.g/255, 0, 0, 0, 0, t.color.b/255, 0, 0, 0, t.color.a, 0];o.setAttribute('values', mt(e)) }:null }, 'grayscale': function(t){ return t?function(e){ t.setAttribute('values', mt(function(t){ return [.2126+.7874*(t=1-t), .7152-.7152*t, .0722-.0722*t, 0, 0, .2126-.2126*t, .7152+.2848*t, .0722-.0722*t, 0, 0, .2126-.2126*t, .7152-.7152*t, .0722+.9278*t, 0, 0, 0, 0, 0, 1, 0] }(e))) }:null }, 'hue-rotate': function(t){ return t?function(e){ return t.setAttribute('values', pt(e)) }:null }, 'invert': function(t, e, n){ return (t=fe(n, e))?function(e){ e=`${pt(e)} ${pt(1-e)}`, t.map(((t) =>{ return t.setAttribute('tableValues', e) })) }:null }, 'opacity': function(t, e, n){ return (t=n.getElementById(`${e}-A`))?function(e){ return t.setAttribute('tableValues', `0 ${pt(e)}`) }:null }, 'saturate': function(t){ return t?function(e){ return t.setAttribute('values', pt(e)) }:null }, 'sepia': function(t){ return t?function(e){ return t.setAttribute('values', mt(function(t){ return [.393+.607*(t=1-t), .769-.769*t, .189-.189*t, 0, 0, .349-.349*t, .686+.314*t, .168-.168*t, 0, 0, .272-.272*t, .534-.534*t, .131+.869*t, 0, 0, 0, 0, 0, 1, 0] }(e))) }:null } };const se=['R', 'G', 'B'];function fe(t, e){ const n=se.map(((n) =>{ return t.getElementById(`${e}-${n}`)||null }));return -1!==n.indexOf(null)?null:n } const ce={ 'fill': te, 'fill-opacity': Xt, 'stroke': te, 'stroke-opacity': Xt, 'stroke-width': Qt, 'stroke-dashoffset': { f: pt, i: D }, 'stroke-dasharray': Jt, 'opacity': Xt, 'transform': function(t, e, r, i){ if (!(t=function(t, e){ if (!t||'object'!==n(t)) return null;let r=!1;for (const i in t)t.hasOwnProperty(i)&&(t[i]&&t[i].length?(t[i].forEach(((t) =>{ t.e&&(t.e=e(t.e)) })), r=!0):delete t[i]);return r?t:null }(t, i))) return null;const o=function(n, i, o){ const u=arguments.length>3&&void 0!==arguments[3]?arguments[3]:null;return t[n]?r(i, t[n], o):e&&e[n]?e[n]:u };return e&&e.a&&t.o?function(e){ const n=r(e, t.o, Gt);return Wt.recomposeSelf(n, o('r', e, D, 0)+n.a, o('k', e, L), o('s', e, L), o('t', e, L)).toString() }:function(t){ return Wt.recomposeSelf(o('o', t, Vt, null), o('r', t, D, 0), o('k', t, L), o('s', t, L), o('t', t, L)).toString() } }, '#filter': function(t, e, n, r, i, o, u, a){ if (!e.items||!t||!t.length) return null;const l=function(t, e){ const n=(t=t.map(((t) =>{ return t&&le[t[0]]?(e.getElementById(t[1]), le[t[0]](e.getElementById(t[1]), t[1], e)):null }))).length;return function(e){ for (let r=0;r<n;r++)t[r]&&t[r](e[r].value) } }(e.items, a);return l?(t=function(t, e){ return t.map(((t) =>{ return t.e=e(t.e), t })) }(t, r), function(e){ l(n(e, t, ae)) }):null }, '#line': Ht, 'points': { f: mt, i: Y }, 'd': $t, 'r': Qt, '#size': At, '#radius': _t, '_': function(t, e){ if (Array.isArray(t)) for (let n=0;n<t.length;n++) this[t[n]]=e;else this[t]=e } }, he={ currentTime: 'offset', duration: 'duration', hasEnded(){ return this.reachedToEnd() }, isAlternate: 'alternate', isPlaying: '_running', isRollingBack: '_rollingBack', state(t, e){ return e.isPlaying?e.isRollingBack?'rollback':'playing':e.hasEnded?'ended':'paused' }, totalTime: 'maxFiniteDuration', iterations: 'iterations', direction: 'direction', fill: 'fill', isReversed(t, e){ return -1===e.direction }, isBackwards(t, e){ return -1===e.fill }, isInfinite(t, e){ return 0===e.iterations }, speed: 'speed', fps: 'fps' }, ve={ destruct: 'destruct', pause: 'pause', play(t, e){ return de(t, e.hasEnded?'restart':'play', e) }, restart: 'restart', reverse(t, e){ return de(t, 'reverse', e, [!0]) }, seek: 'seek', seekBy: 'seekBy', seekTo: 'seekTo', stop: 'stop', toggle: 'toggle', togglePlay: 'toggle', set: 'set' };function de(t, e, n){ const r=arguments.length>3&&void 0!==arguments[3]?arguments[3]:[];return function(){ let i, o=Array.prototype.slice.call(arguments);return o.unshift.apply(o, v(r)), (i=t[e]).call.apply(i, [t].concat(v(o))), n } } const ye=function t(e){ r(this, t);const n={}, i=['on', 'off'], o={ get(t, e, r){ return he[e]?'function'==typeof he[e]?he[e].call(t, t, r):t[he[e]]:ve[e]?'function'==typeof ve[e]?ve[e].call(t, t, r):de(t, ve[e], r):-1!==i.indexOf(e)?n[e]:'ready'===e?function(t){ return t&&t.call(r, r), r }:void 0 }, set(t, e, r){ return -1!==i.indexOf(e)&&(n[e]=r) }, ownKeys(t){ return Object.keys(he) }, has(t, e){ return void 0!==he[e] } };if ('function'==typeof Proxy) return new Proxy(e, o);const u=Object.keys(he).concat(Object.keys(ve)).concat(i), a={};return u.forEach(((t) =>{ const n={ enumerable: !1, configurable: !1, get(){ return o.get(e, t, a) } };-1!==i.indexOf(t)&&(n.set=function(n){ return o.set(e, t, n) }), Object.defineProperty(a, t, n) })), a };function ge(t){ t||(t=this);const e={};this.on=function(t, n){ const r=arguments.length>2&&void 0!==arguments[2]&&arguments[2];return 'function'==typeof n&&(t.split(/[, ]+/g).forEach(((t) =>{ return e[t]=e[t]||[], r?e[t].unshift(n):e[t].push(n) })), !0) }, this.off=function(t, n){ for (const r in e) if (e.hasOwnProperty(r)&&r.substr(0, t.length)===t) if (n) for (let i=0;i<e[r].length;i++)e[r][i]===n&&(e[r][i]=null);else e[r]=null }, this.trigger=function(){ let n, r=Array.prototype.slice.call(arguments), i=r[0], o=r.slice(1);t:for (const u in e) if (e.hasOwnProperty(u)&&e[u]&&(u===i||u.substr(0, i.length+1)===`${i}.`)) for (let a=0;a<(e[u]||[]).length;a++) if (e[u][a]&&!1===(n=e[u][a].apply(t, o))) break t;return n } } const pe=!0, me=['iterations', 'speed', 'fps', 'direction', 'fill', 'alternate'], be=function(t){
            !function(t, e){ if ('function'!=typeof e&&null!==e) throw new TypeError('Super expression must either be null or a function');t.prototype=Object.create(e&&e.prototype, { constructor: { value: t, writable: !0, configurable: !0 } }), e&&l(t, e) }(u, t);let e, n, i=(e=u, n=s(), function(){
                let t, r=a(e);if (n){ const i=a(this).constructor;t=Reflect.construct(r, arguments, i) }
                else { t=r.apply(this, arguments) } return c(this, t)
            });function u(t, e){ let n, o=arguments.length>2&&void 0!==arguments[2]?arguments[2]:null;return r(this, u), (n=i.call(this, t, e, o))._handlers=[], n } return o(u, [{ key: '_adjustOffset', value(){ const t=arguments.length>0&&void 0!==arguments[0]&&arguments[0], e=this.alternate?2*this.duration:this.duration;if (t){ if (!this._rollingBack&&0===this.offset) return void(this.offset=e);this._rollingBack&&(this.offset, this.maxFiniteDuration) }!this._rollingBack||this.rollbackStartOffset<=this.duration?0!==this.iterations&&(this.offset=Math.min(this.offset, this.maxFiniteDuration)):(this.offset=this.rollbackStartOffset-(this.rollbackStartOffset-this.offset)%e, this.rollbackStartOffset=0) } }, { key: 'reverse', value(){ const t=arguments.length>0&&void 0!==arguments[0]&&arguments[0];if (!this._running) return this._adjustOffset(t), this._rollingBack=!this._rollingBack, t&&this.play(!1), void this.trigger('reverse', this.offset);this.pause(!1, !1), this._adjustOffset(), this._rollingBack=!this._rollingBack, this.play(!1), this.trigger('reverse', this.offset) } }, { key: 'play', value(){ const t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:pe, e=h(a(u.prototype), 'play', this).call(this);return t===pe&&this.trigger('play', this.offset), e } }, { key: 'pause', value(){ const t=arguments.length>0&&void 0!==arguments[0]&&arguments[0], e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:pe, n=h(a(u.prototype), 'pause', this).call(this);return e===pe&&this.trigger(t?'end':'pause', this.offset), n } }, { key: 'restart', value(){ const t=h(a(u.prototype), 'restart', this).call(this, !1);return this.trigger('restart', this.offset), t } }, { key: 'stop', value(){ const t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:pe, e=h(a(u.prototype), 'stop', this).call(this);return t===pe&&this.trigger('stop', this.offset), e } }, { key: '_apply', value(t){ const e=this, n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:pe, r=h(a(u.prototype), '_apply', this).call(this, t);if (n===pe){ const i=function(){ return e.trigger('keyframe', t) };window.requestAnimationFrame(i) } return r } }, { key: 'seekTo', value(t){ let e, n, r, i=this._running;i&&this.pause(!1, !1), this.offset=this.iterations>0?(e=t, n=0, r=this.maxFiniteDuration, e<n?n:e>r?r:e):Math.max(t, 0), this._apply(this.offset), i&&this.play(!1) } }, { key: 'seek', value(t){ return this.seekTo(Math.round(t/100*this.maxFiniteDuration)) } }, { key: 'seekBy', value(t){ return this.seekTo(this.offset+t) } }, { key: 'toggle', value(){ return this._running?this.pause():this.reachedToEnd()?this.restart():this.play() } }, { key: 'set', value(t, e){ if (me.includes(t)){ const n=this._running;n&&this.pause(!1, !1), this._settings[t]=e, n?this.play(!1):this._apply(this.offset, {}, !1) } } }, { key: 'destruct', value(){ const t=this;this.stop(), this._handlers.forEach(((t) =>{ t.element?t.element.removeEventListener(t.event, t.handler):t.callback&&t.callback.call&&t.callback.call() }));const e=function(){}, n=Object.getOwnPropertyNames(Object.getPrototypeOf(this));n.push.apply(n, v(Object.getOwnPropertyNames(this))), n.forEach(((n) =>{ 'function'==typeof t[n]?t[n]=e:delete t[n] })) } }], [{ key: 'build', value(t){ const e=h(a(u), 'build', this).call(this, t, ce);if (!e) return null;const n=e.el, r=e.options, i=e.player, o=new ye(i), l=new ge(o);o.on=l.on, o.off=l.off, i.trigger=l.trigger;const s=n.svgatorPlayer&&n.svgatorPlayer.ready&&n.svgatorPlayer.ready.call&&n.svgatorPlayer.ready.call();n.svgatorPlayer=o, function(t){ let e, n, r=t&&1===(null===(e=t.ownerDocument)||void 0===e||null===(n=e.childNodes)||void 0===n?void 0:n.length)&&window.parent!==window, i=null==t?void 0:t.firstElementChild;if (!r||!i||'a'!==i.tagName||i.getAttribute('target')) return;i.setAttributeNS(null, 'target', '_parent') }(n), function(t, e, n){ if ('click'===n.start){ const r=function(){ switch (n.click){ case 'freeze':return !t._running&&t.reachedToEnd()?t.restart():t.toggle();case 'restart':return t.offset>0?t.restart():t.play();case 'reverse':return t._running?t.reverse():t.reachedToEnd()?1===t.fill?t.reverse(!0):t.restart():t.play();case 'none':default:if (t._running) return;return t.reachedToEnd()?t.restart():t.play() } };return t._handlers.push({ element: e, event: 'click', handler: r }), void e.addEventListener('click', r) } if ('hover'===n.start){ const i=function(){ return t.reachedToEnd()?t.restart():t._rollingBack?t.reverse():t.play() };t._handlers.push({ element: e, event: 'mouseenter', handler: i }), e.addEventListener('mouseenter', i);const o=function(){ switch (n.hover){ case 'freeze':return t.pause();case 'reset':return t.stop();case 'reverse':if (t.reverse(), t._running) return;return t.play();case 'none':default:return } };return t._handlers.push({ element: e, event: 'mouseleave', handler: o }), void e.addEventListener('mouseleave', o) } if ('scroll'===n.start){ const u=new gt(e, n.scroll||25, ((e) =>{ e?t.reachedToEnd()?t.restart():t.play():t.pause() }));return void t._handlers.push({ callback(){ return u.destruct() } }) } if ('programmatic'===n.start) return;t.play() }(i, n, r), function(t, e, n){ let r;'function'==typeof Event?r=new Event('ready'):(r=document.createEvent('Event')).initEvent('ready', !0, !0);if (t.dispatchEvent(r), !n||!n.length) return;n.forEach(((t) =>{ return e.ready(t) })) }(n, n.svgatorPlayer, s) } }]), u
        }(yt);return be.init(), be
    }));
    (function(s, i, o, w, d, a, b){ (a=Array.from(d.querySelectorAll(`svg#${i.root}`)).filter(n=> !n.svgatorPlayer)[0]||{}).svgatorPlayer={ ready: (function(a){ b=[];return function(c){ return c?(b.push(c), a.svgatorPlayer):b } })(a) };w[o]=w[o]||{};w[o][s]=w[o][s]||[];w[o][s].push(i) })('91c80d77', { root: 'egsedXVF9BO1', version: '2022-05-04', animations: [{ elements: { egsedXVF9BO3: { transform: { data: { t: { x: -256.000274, y: -256.001205 } }, keys: { o: [{ t: 100, v: { x: 59.245107, y: 70.340856, type: 'cusp', end: { x: 110.349575, y: -29.504868 } }, e: [0.44, 0.45, 0.61, 0.43] }, { t: 1000, v: { x: 304.260344, y: 84.50403, type: 'cusp', start: { x: 296.058915, y: 14.589438 } }, e: [0.165, 0.84, 0.44, 1] }], r: [{ t: 100, v: -45.884921 }, { t: 300, v: -23.129854 }, { t: 320, v: -12.809951 }, { t: 600, v: 21.812234 }, { t: 800, v: 54.109858 }, { t: 1000, v: 80 }], s: [{ t: 100, v: { x: -0.08, y: 0.08 } }, { t: 900, v: { x: -0.08, y: 0.08 } }, { t: 1000, v: { x: 0, y: 0 } }] } }, opacity: [{ t: 100, v: 0 }, { t: 200, v: 1 }, { t: 800, v: 1 }, { t: 1000, v: 0 }] }, egsedXVF9BO12: { transform: { data: { o: { x: 238.284353, y: 77.20177, type: 'corner' }, t: { x: -33.556819, y: 6.405038 } }, keys: { r: [{ t: 800, v: 0, e: [0, 0, 0.58, 1] }, { t: 1000, v: 10, e: [0, 0, 0.58, 1] }, { t: 1400, v: 0, e: [0.175, 0.885, 0.32, 1.275] }] } } }, egsedXVF9BO23: { transform: { data: { s: { x: -1, y: 1 }, t: { x: -69.983665, y: -36.766717 } }, keys: { o: [{ t: 100, v: { x: 14.150976, y: 81.433158, type: 'corner' }, e: [0, 0, 0.58, 1] }, { t: 1500, v: { x: 89.97, y: 81.433158, type: 'corner' } }] } } }, egsedXVF9BO26: { transform: { data: { t: { x: -69.983665, y: -36.766717 } }, keys: { o: [{ t: 0, v: { x: 89.97194, y: 81.433158, type: 'corner' }, e: [0, 0, 0.58, 1] }, { t: 1400, v: { x: 14.15, y: 81.433158, type: 'corner' } }] } } }, egsedXVF9BO38: { transform: { data: { t: { x: -62.491485, y: -143.881688 } }, keys: { o: [{ t: 800, v: { x: 62.491485, y: 143.881688, type: 'corner' } }, { t: 1200, v: { x: -162.22062, y: -114.898213, type: 'corner' } }], s: [{ t: 800, v: { x: 0, y: 0 } }, { t: 1000, v: { x: 1, y: 1 } }, { t: 1200, v: { x: 0, y: 0 } }] } } }, egsedXVF9BO41: { transform: { data: { r: -18.307389, t: { x: -343.023675, y: -148.956245 } }, keys: { o: [{ t: 800, v: { x: 325.628494, y: 95.912833, type: 'corner' }, e: [0, 0, 0.58, 1] }, { t: 1200, v: { x: 505.134319, y: -288.179502, type: 'corner' } }], s: [{ t: 800, v: { x: 0, y: 0 } }, { t: 1000, v: { x: 1, y: 1 } }, { t: 1200, v: { x: 0, y: 0 } }] } } }, egsedXVF9BO46: { transform: { data: { r: 95.903187, t: { x: -123.582497, y: -296.499023 } }, keys: { o: [{ t: 900, v: { x: 211.21129, y: 145.140183, type: 'corner' } }, { t: 1300, v: { x: 187.312521, y: -153.594394, type: 'corner' } }], s: [{ t: 900, v: { x: 0, y: 0 } }, { t: 1100, v: { x: 1, y: 1 } }, { t: 1300, v: { x: 0, y: 0 } }] } } }, egsedXVF9BO47: { transform: { data: { o: { x: 154.743687, y: 183.30657, type: 'corner' }, t: { x: -154.743687, y: -272.86802 } }, keys: { s: [{ t: 800, v: { x: 0, y: 0 } }, { t: 1200, v: { x: 2.2, y: 2.2 } }] } }, opacity: [{ t: 800, v: 1 }, { t: 1200, v: 0 }] }, egsedXVF9BO52: { transform: { data: { r: -53.980525, t: { x: -378.242919, y: -348.641937 } }, keys: { o: [{ t: 800, v: { x: 432.36268, y: 216.061283, type: 'corner' } }, { t: 1200, v: { x: 744.817353, y: 117.706305, type: 'corner' } }], s: [{ t: 800, v: { x: 0, y: 0 } }, { t: 1000, v: { x: 1, y: 1 } }, { t: 1200, v: { x: 0, y: 0 } }] } } } }, s: 'MDUA1ZGNlNzVHYWjdjOGM1YjRjFN2JjYzJjMTcQ1OGQ4NDg4ODXM4MzdmRzc1YRjdiY0VjNWI4RUWI2YzdiY2MLyYzE3NThkODMQ3Zjc1YmNjNE2I4YzViNGM3LYmNjMmMxWWMI2NzU4ZDg0N2KY3NWI5U2JjYQmZiZjc1OGQ4KNDdmNzViNGJUmYzdiOGM1YzXFiNEpjN2I4UWDc1OGRiOWI0HYmZjNmI4N2YM3NWM2WWMzYjRhiOGI3NzU4ZWDg0N2Y3NWI5KYzNjNjc1OGQX4NDgzODNkMAA|' }], options: 'MDFAyMDkyMzk4YHVI4Yjc4ODk4YYjM5NTEzOTdLmODY4ZDdjODOkzOTQzSTM5NC2ZEODY4ZDdjQODkzOVI1MVEWzOTg1ODZQODMU3YzM5OTQ/' }, '__SVGATOR_PLAYER__', window, document)
})

</script>

<template>
    <div>
        <nuxt-link
            to="/"
            class="relative
            grid h-[53px]
            "
            aria-label="Home"
            >
            <svg
                id="egsedXVF9BO1"
                class="w-64 [grid-area:1/-1] self-top relative -top-6"
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 0 330 110"
                shape-rendering="geometricPrecision"
                text-rendering="geometricPrecision"
                ><defs><linearGradient
                    id="egsedXVF9BO12-fill"
                    x1="0"
                    y1="0.5"
                    x2="1"
                    y2="0.5"
                    spreadMethod="pad"
                    gradientUnits="objectBoundingBox"
                    gradientTransform="translate(0 0)"
                    ><stop
                        id="egsedXVF9BO12-fill-0"
                        offset="0%"
                        stop-color="#22d3ee"
                        /><stop
                        id="egsedXVF9BO12-fill-1"
                        offset="100%"
                        stop-color="#08afff"
                        /></linearGradient><linearGradient
                    id="egsedXVF9BO20-stroke"
                    x1="0.279385"
                    y1="0.045611"
                    x2="0.811838"
                    y2="0.894481"
                    spreadMethod="pad"
                    gradientUnits="objectBoundingBox"
                    gradientTransform="translate(0 0)"
                    ><stop
                        id="egsedXVF9BO20-stroke-0"
                        offset="0%"
                        stop-color="#6ed1e7"
                        /><stop
                        id="egsedXVF9BO20-stroke-1"
                        offset="100%"
                        stop-color="#1974c3"
                        /></linearGradient><linearGradient
                    id="egsedXVF9BO24-fill"
                    x1="0.5"
                    y1="0.000038"
                    x2="0.5"
                    y2="0.203899"
                    spreadMethod="pad"
                    gradientUnits="objectBoundingBox"
                    gradientTransform="translate(0 0)"
                    ><stop
                        id="egsedXVF9BO24-fill-0"
                        offset="0%"
                        stop-color="#60cbf9"
                        /><stop
                        id="egsedXVF9BO24-fill-1"
                        offset="100%"
                        stop-color="#0159b8"
                        /></linearGradient><linearGradient
                    id="egsedXVF9BO25-fill"
                    x1="0.5"
                    y1="0"
                    x2="0.5"
                    y2="0.203468"
                    spreadMethod="pad"
                    gradientUnits="objectBoundingBox"
                    gradientTransform="translate(0 0)"
                    ><stop
                        id="egsedXVF9BO25-fill-0"
                        offset="0%"
                        stop-color="#60cbf9"
                        /><stop
                        id="egsedXVF9BO25-fill-1"
                        offset="100%"
                        stop-color="#0159b8"
                        /></linearGradient><linearGradient
                    id="egsedXVF9BO27-fill"
                    x1="0.5"
                    y1="0.000038"
                    x2="0.5"
                    y2="0.640568"
                    spreadMethod="pad"
                    gradientUnits="objectBoundingBox"
                    gradientTransform="translate(0 0)"
                    ><stop
                        id="egsedXVF9BO27-fill-0"
                        offset="0%"
                        stop-color="#6ce3e5"
                        /><stop
                        id="egsedXVF9BO27-fill-1"
                        offset="100%"
                        stop-color="#015ab8"
                        /></linearGradient><linearGradient
                    id="egsedXVF9BO28-fill"
                    x1="0.5"
                    y1="0"
                    x2="0.5"
                    y2="0.640554"
                    spreadMethod="pad"
                    gradientUnits="objectBoundingBox"
                    gradientTransform="translate(0 0)"
                    ><stop
                        id="egsedXVF9BO28-fill-0"
                        offset="0%"
                        stop-color="#6ce3e5"
                        /><stop
                        id="egsedXVF9BO28-fill-1"
                        offset="100%"
                        stop-color="#015ab8"
                        /></linearGradient><linearGradient
                    id="egsedXVF9BO31-fill"
                    x1="0.359922"
                    y1="0.018137"
                    x2="0.519734"
                    y2="1"
                    spreadMethod="pad"
                    gradientUnits="objectBoundingBox"
                    gradientTransform="translate(0 0)"
                    ><stop
                        id="egsedXVF9BO31-fill-0"
                        offset="0%"
                        stop-color="rgba(255,255,255,0.55)"
                        /><stop
                        id="egsedXVF9BO31-fill-1"
                        offset="36.5917%"
                        stop-color="rgba(175,171,231,0)"
                        /></linearGradient></defs><g transform="translate(0 7.034181)"><g
                    id="egsedXVF9BO3"
                    transform="matrix(-.055688 0.057435 0.057435 0.055688 58.797742 41.381134)"
                    opacity="0"
                    ><path
                        d="M212.071,219.43c-1.933-4.159-6.874-5.96-11.03-4.031-.554.257-1.063.571-1.529.927l-16.499-21.668c-14.395-3.739-28.104-6.439-40.896-8.379-.598-1.413-.91-2.239-.932-2.298-1.586-4.297-6.353-6.504-10.656-4.918-4.305,1.582-6.512,6.354-4.929,10.659.783,2.13,19.654,52.364,60.958,69.404c3.029,1.251,6.18,1.872,9.274,1.872c3.703,0,7.328-.89,10.573-2.657c5.569-3.032,9.166-7.938,10.399-14.189c1.353-6.868-.194-14.956-4.733-24.722Z"
                        fill="#0099df"
                        /><path
                        d="M511.886,454.07c-.462-2.751-11.342-65.281-48.955-91.179.987-19.292-2.498-86.165-78.917-198.614-1.578-8.246-8.02-50.999,23.582-69.122c4.917-2.82,7.744-8.096,7.375-13.766-.373-5.753-3.916-10.692-9.247-12.891-12.361-5.098-47.453-7.84-93.925,16.684-8.201-5.795-27.11-17.706-54.733-26.482-34.019-10.809-88.343-18.694-153.916,5.102-2.202.792-52.786,19.482-66.452,67.943-3.542,1.77-9.245,4.748-15.005,8.289C6.691,149.26,0,156.861,0,164.681c0,5.723,2.282,10.919,6.598,15.022c9.108,8.662,26.817,12.204,54.16,10.826c50.283-2.534,99.617,4.209,146.615,20.04c80.558,27.133,149.064,79.205,203.76,154.847-11.479,6.239-30.974,19.588-46.72,44.26-1.755,2.75-1.728,6.273.055,9.006c1.784,2.733,5.009,4.162,8.236,3.666.634-.097,63.878-9.23,125.853,39.618c1.499,1.18,3.316,1.782,5.142,1.782c1.457,0,2.92-.383,4.231-1.159c2.951-1.749,4.523-5.135,3.956-8.519Z"
                        fill="#65b9e9"
                        /><path
                        d="M462.931,362.891c.987-19.292-2.498-86.165-78.917-198.614-1.578-8.246-8.02-50.999,23.582-69.122c4.917-2.82,7.744-8.096,7.375-13.766-.373-5.753-3.916-10.692-9.247-12.891-9.185-3.787-30.925-6.265-60.553,2.767c7.218.999,15.855,1.914,26.085,2.709.403.031.819.076,1.219.14c3.276.515,5.948,1.24,7.938,2.061c5.044,2.079,5.638,9.062.906,11.776-40.667,23.323-27.242,79.637-27.242,79.637c90.021,131.883,77.969,199.603,77.969,199.603c25.728,14.779,39.199,49.359,45.291,70.579.891,3.211,2.168,7.329,3.708,11.872c5.812,3.631,11.666,7.72,17.509,12.325c1.499,1.18,3.316,1.782,5.142,1.782c1.457,0,2.92-.383,4.231-1.159c2.953-1.748,4.525-5.134,3.958-8.518-.461-2.755-11.341-65.283-48.954-91.181Z"
                        fill="#0099df"
                        /><path
                        d="M238.543,155.957c-67.962-21.455-133.584,9.327-164.638,34.124.182.003.37.011.551.014c45.541-.771,90.195,6.083,132.917,20.474c80.558,27.133,149.064,79.205,203.76,154.847-.002-.001-48.232-170.201-172.59-209.459Z"
                        fill="#d9d9db"
                        /><path
                        d="M263.855,222.625c-9.624-14.338-24.169-36.004-21.514-67.497.373-4.435-2.812-8.338-7.176-8.918l.166-1.241-72.179-8.783c-.742-.298-1.41-.396-1.969-.239-4.415,1.246-.428,17.85.816,22.263.296,1.047,7.407,25.933,22.259,50.176c18.729,30.573,41.583,46.493,66.503,46.493c2.649,0,5.32-.179,8.013-.54c2.454-.33,9.922-1.331,12.888-7.919c3.28-7.279-1.37-14.206-7.807-23.795Z"
                        fill="#65b9e9"
                        /><path
                        d="M13.175,173.069c-2.99,0-4.849-.074-5.235-.091-4.582-.203-8.133-4.081-7.931-8.662.202-4.583,4.085-8.125,8.662-7.931.77.032,51.282,1.89,80.607-18.26c3.78-2.599,8.95-1.639,11.547,2.143c2.598,3.78,1.639,8.95-2.141,11.547-28.301,19.445-70.721,21.254-85.509,21.254Z"
                        fill="#0099df"
                        /><path d="M116.746,122.784c-5.267,0-9.552-4.277-9.552-9.536c0-5.258,4.285-9.537,9.552-9.537s9.552,4.278,9.552,9.537c0,5.258-4.285,9.536-9.552,9.536Z" /></g><g transform="matrix(1.286598 0 0 1.286598-26.660856-21.277146)"><text
                    id="egsedXVF9BO12"
                    dx="0"
                    dy="0"
                    font-family="&quot;Poppins&quot;"
                    font-size="20"
                    font-weight="700"
                    transform="translate(204.727534 83.606808)"
                    fill="url(#egsedXVF9BO12-fill)"
                    stroke-width="0"
                    ><tspan
                        y="0"
                        font-weight="700"
                        stroke-width="0"
                        ><![CDATA[
Ocean
]]></tspan></text><text
dx="0"
dy="0"
font-family="&quot;Poppins&quot;"
font-size="20"
font-weight="700"
transform="translate(110.318366 83.606808)"
fill="currentColor"
stroke-width="0"
><tspan
y="0"
font-weight="700"
stroke-width="0"
><![CDATA[
Package
]]></tspan></text><text
dx="0"
dy="0"
font-family="&quot;Poppins&quot;"
font-size="18"
font-weight="400"
transform="translate(110.318366 56.009654)"
fill="currentColor"
stroke-width="0"
><tspan
y="0"
font-weight="400"
stroke-width="0"
><![CDATA[
Laravel
]]></tspan></text></g><ellipse
rx="35.999748"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               ry="35.999748"
transform="matrix(.980359 0 0 0.980359 52.061458 60.871635)"
fill="none"
stroke="url(#egsedXVF9BO20-stroke)"
stroke-width="2"
                    /><g transform="matrix(.966926 0 0 0.966926 1.721834 2.350767)"><g clip-path="url(#egsedXVF9BO29)"><g
                        id="egsedXVF9BO23"
                        transform="matrix(-1 0 0 1 84.134641 44.666441)"
                        ><path
                            d="M114.206896,53.342013c0,0,11.682028,6.917989,20.196538,6.070756c8.134324-.809403,14.552629-8.008341,23.410145-10.870806c8.899685-2.876093,26.599019,4.896828,26.599019,4.896828v51.227841l-70.277107-.021123.071405-51.303496Z"
                            transform="matrix(.999359 0 0 1.000394-44.327058-36.020801)"
                            fill="url(#egsedXVF9BO24-fill)"
                            stroke-width="0.6"
                            /><path
                            d="M114.415159,53.438791c0,0,11.473765,6.821211,19.988275,5.973978c8.134324-.809403,14.552629-8.008341,23.410145-10.870806c8.899685-2.876093,26.599019,4.896828,26.599019,4.896828v51.248024h-69.997439v-51.248024Z"
                            transform="translate(-114.415159-35.999746)"
                            fill="url(#egsedXVF9BO25-fill)"
                            stroke-width="0.6"
                            /></g><g
                        id="egsedXVF9BO26"
                        transform="translate(19.988275 44.666441)"
                        ><path
                            d="M114.206896,53.342013c0,0,11.682028,6.917989,20.196538,6.070756c8.134324-.809403,14.552629-8.008341,23.410145-10.870806c8.899685-2.876093,26.599019,4.896828,26.599019,4.896828v51.227841l-70.277107-.021123.071405-51.303496Z"
                            transform="matrix(.999359 0 0 1.000394-44.327058-36.020801)"
                            fill="url(#egsedXVF9BO27-fill)"
                            stroke-width="0.6"
                            /><path
                            d="M114.415159,53.438791c0,0,11.473765,6.821211,19.988275,5.973978c8.134324-.809403,14.552629-8.008341,23.410145-10.870806c8.899685-2.876093,26.599019,4.896828,26.599019,4.896828v51.248024h-69.997439v-51.248024Z"
                            transform="translate(-114.415159-35.999746)"
                            fill="url(#egsedXVF9BO28-fill)"
                            stroke-width="0.6"
                            /></g><clipPath id="egsedXVF9BO29"><ellipse
                        rx="35.999748"
                        ry="35.999748"
                        transform="matrix(.890928 0 0 0.890928 52.061458 60.871635)"
                        fill="#d2dbed"
                        stroke-width="0"
                        /></clipPath></g><ellipse
                        rx="35.999748"
                        ry="35.999748"
                        transform="matrix(.890928 0 0 0.890928 52.061458 60.871635)"
                        fill="url(#egsedXVF9BO31-fill)"
                        stroke-width="0"
                        /><g transform="translate(0 0.000001)"><path
                            d="M27.60901,50.878008c.905302-1.379206,7.551364-4.586927,10.468605-4.726729"
                            transform="matrix(.998992-.044893 0.044893 0.998992 7.519453-8.088362)"
                            fill="none"
                            stroke="#fff"
                            stroke-width="4"
                            stroke-opacity="0.5"
                            stroke-linecap="round"
                            /><path
                                d="M27.854782,51.10769c.786737-1.858793,1.276792-2.787775,2.925838-4.319429"
                                transform="matrix(.998992 0.044882-.044882 0.998992 3.571782-1.861653)"
                                fill="none"
                                stroke="#fff"
                                stroke-width="4"
                                stroke-opacity="0.5"
                                stroke-linecap="round"
                                /></g></g><g transform="matrix(.057851 0.007075-.007075 0.057851 282.64834 54.165558)"><g
                        id="egsedXVF9BO38"
                        transform="matrix(0 0 0 0 62.491485 143.881688)"
                        ><path
                            d="M213.563,261.031L56.3,161.613C-0.682,126.403,-14.557,56.132,37.97,16.829c.139-.107.277-.202.416-.298c55.352-40.933,132.582-.703,133.275,64.367.16,14.845,2.067,57.377,17.36,106.036c6.991,22.198,16.753,45.665,30.415,68.364c2.29,3.804-2.111,8.109-5.873,5.733Z"
                            transform="translate(-49.450741 13.013356)"
                            fill="#07a9f0"
                            /><path
                            d="M189.02,186.934L85.958,121.778C45.174,96.585,26.471,53.435,38.386,16.531c55.352-40.933,132.582-.703,133.275,64.367.159,14.845,2.067,57.377,17.359,106.036Z"
                            transform="translate(-49.450741 13.013356)"
                            fill="#40c1fa"
                            /></g><g
                        id="egsedXVF9BO41"
                        transform="matrix(0 0 0 0 325.628494 95.912833)"
                        ><path
                            d="M456.944,133.863c0,0-36.574,11.392-96.764,54.435-24.021,17.179-51.792,39.398-82.505,67.948-2.963,2.76-7.513-.725-5.627-4.305L375.313,56.547c27.548-48.435,75.227-71.071,113.868-36.361c10.945,9.826,17.925,21.74,20.919,34.187c7.503,31.193-10.059,65.774-53.156,79.49Z"
                            transform="translate(-49.450741 13.013356)"
                            fill="#07a9f0"
                            /><path
                            d="M456.944,133.863c0,0-36.574,11.392-96.764,54.435l47.178-89.262c24.958-43.874,66.424-66.584,102.743-44.663c7.502,31.193-10.06,65.774-53.157,79.49Z"
                            transform="translate(-49.450741 13.013356)"
                            fill="#40c1fa"
                            /></g><path
                        id="egsedXVF9BO46"
                        d="M185.387,275.642L148.28,312.291c-25.481,28.773-72.893,20.152-86.502-15.804c8.835-22.614,33.452-37.864,59.87-31.587l63.739,10.742Z"
                        transform="matrix(0 0 0 0 211.21129 145.140183)"
                        fill="#93dcfc"
                        /><g
                            id="egsedXVF9BO47"
                            transform="matrix(0 0 0 0 154.743687 183.30657)"
                            ><path
                                d="M277.074,173.678l-22.631,44.265c-.12.237-.253.459-.398.67-2.475,3.639-8.107,3.418-10.199-.665l-22.672-44.245c-12.829-21.396,2.478-49.23,27.926-49.242c1.681-.001,3.317.119,4.904.353c22.444,3.282,35.044,28.851,23.07,48.864Z"
                                transform="translate(-49.450741 13.013356)"
                                fill="#2dc0ff"
                                /><path
                                d="M479.449,226.69l-34.93-7.783c-.186-.042-.366-.094-.538-.157-2.983-1.068-3.844-5.032-1.377-7.227l26.74-23.783c12.594-12.8,34.753-7.157,39.354,10.575.304,1.171.516,2.334.639,3.482c1.762,16.231-13.782,29.626-29.888,24.893Z"
                                transform="translate(-148.970548 45.80966)"
                                fill="#2dc0ff"
                                /><path
                                d="M41.817,200.781l24.404,26.174c.131.14.249.283.356.434c1.855,2.568.324,6.324-2.952,6.738l-35.503,4.489c-17.626,3.433-32.708-13.755-26.473-30.979.411-1.137.894-2.217,1.442-3.232c7.727-14.383,28.121-16.636,38.726-3.624Z"
                                transform="translate(47.098988 40.598978)"
                                fill="#2dc0ff"
                                /></g><g
                            id="egsedXVF9BO52"
                            transform="matrix(0 0 0 0 432.36268 216.061283)"
                            ><path
                                d="M466.536,382.189c-1.694,3.186-3.57,6.17-5.606,8.941-1.929,2.622-4.007,5.062-6.213,7.321-30.638,31.459-85.479,27.154-109.616-12.82L284.016,298.16c-.33-.469-.618-.938-.874-1.428-4.401-8.355,1.694-18.799,11.531-18.66l23.616.352l83.06,1.247c53.464-2.751,90.795,54.285,65.187,102.518Z"
                                fill="#40c1fa"
                                /><path
                                d="M466.536,382.189c-1.694,3.186-3.57,6.17-5.606,8.941-1.929,2.622-4.007,5.062-6.213,7.321-27.644,6.021-58.453-4.646-74.939-31.949l-61.085-87.471c-.139-.202-.277-.405-.405-.607l83.06,1.247c53.465-2.751,90.796,54.285,65.188,102.518Z"
                                fill="#93dcfc"
                                /></g></g></g>
            </svg>
        </nuxt-link>
    </div>
</template>