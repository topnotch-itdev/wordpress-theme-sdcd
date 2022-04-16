let isIE11 = navigator.msMaxTouchPoints !== void 0;

if (!isIE11) {
    ! function() {
        if (sessionStorage.criticalFoftDataUriFontsLoaded) return void(document.documentElement.className += " fonts-stage-1 fonts-stage-2");
        ! function() {
            function a(a, b) { document.addEventListener ? a.addEventListener("scroll", b, !1) : a.attachEvent("scroll", b) }

            function b(a) { document.body ? a() : document.addEventListener ? document.addEventListener("DOMContentLoaded", function b() { document.removeEventListener("DOMContentLoaded", b), a() }) : document.attachEvent("onreadystatechange", function b() { "interactive" != document.readyState && "complete" != document.readyState || (document.detachEvent("onreadystatechange", b), a()) }) }

            function c(a) { this.a = document.createElement("div"), this.a.setAttribute("aria-hidden", "true"), this.a.appendChild(document.createTextNode(a)), this.b = document.createElement("span"), this.c = document.createElement("span"), this.h = document.createElement("span"), this.f = document.createElement("span"), this.g = -1, this.b.style.cssText = "max-width:none;display:inline-block;position:absolute;height:100%;width:100%;overflow:scroll;font-size:16px;", this.c.style.cssText = "max-width:none;display:inline-block;position:absolute;height:100%;width:100%;overflow:scroll;font-size:16px;", this.f.style.cssText = "max-width:none;display:inline-block;position:absolute;height:100%;width:100%;overflow:scroll;font-size:16px;", this.h.style.cssText = "display:inline-block;width:200%;height:200%;font-size:16px;max-width:none;", this.b.appendChild(this.h), this.c.appendChild(this.f), this.a.appendChild(this.b), this.a.appendChild(this.c) }

            function d(a, b) { a.a.style.cssText = "max-width:none;min-width:20px;min-height:20px;display:inline-block;overflow:hidden;position:absolute;width:auto;margin:0;padding:0;top:-999px;left:-999px;white-space:nowrap;font:" + b + ";" }

            function e(a) {
                var b = a.a.offsetWidth,
                    c = b + 100;
                return a.f.style.width = c + "px", a.c.scrollLeft = c, a.b.scrollLeft = a.b.scrollWidth + 100, a.g !== b && (a.g = b, !0)
            }

            function f(b, c) {
                function d() {
                    var a = f;
                    e(a) && null !== a.a.parentNode && c(a.g)
                }
                var f = b;
                a(b.b, d), a(b.c, d), e(b)
            }

            function g(a, b) {
                var c = b || {};
                this.family = a, this.style = c.style || "normal", this.weight = c.weight || "normal", this.stretch = c.stretch || "normal"
            }

            function h() { if (null === k) { var a = document.createElement("div"); try { a.style.font = "condensed 100px sans-serif" } catch (a) {} k = "" !== a.style.font } return k }

            function i(a, b) { return [a.style, a.weight, h() ? a.stretch : "", "100px", b].join(" ") }
            var j = null,
                k = null,
                l = null;
            g.prototype.load = function(a, e) {
                var g = this,
                    h = a || "BESbswy",
                    k = e || 3e3,
                    m = (new Date).getTime();
                return new Promise(function(a, e) {
                    if (null === l && (l = !!window.FontFace), l) {
                        var n = new Promise(function(a, b) {
                                function c() {
                                    (new Date).getTime() - m >= k ? b() : document.fonts.load(i(g, g.family), h).then(function(b) { 1 <= b.length ? a() : setTimeout(c, 25) }, function() { b() })
                                }
                                c()
                            }),
                            o = new Promise(function(a, b) { setTimeout(b, k) });
                        Promise.race([o, n]).then(function() { a(g) }, function() { e(g) })
                    } else b(function() {
                        function b() {
                            var b;
                            (b = -1 != q && -1 != r || -1 != q && -1 != s || -1 != r && -1 != s) && ((b = q != r && q != s && r != s) || (null === j && (b = /AppleWebKit\/([0-9]+)(?:\.([0-9]+))/.exec(window.navigator.userAgent), j = !!b && (536 > parseInt(b[1], 10) || 536 === parseInt(b[1], 10) && 11 >= parseInt(b[2], 10))), b = j && (q == t && r == t && s == t || q == u && r == u && s == u || q == v && r == v && s == v)), b = !b), b && (null !== w.parentNode && w.parentNode.removeChild(w), clearTimeout(x), a(g))
                        }

                        function l() {
                            if ((new Date).getTime() - m >= k) null !== w.parentNode && w.parentNode.removeChild(w), e(g);
                            else { var a = document.hidden;!0 !== a && void 0 !== a || (q = n.a.offsetWidth, r = o.a.offsetWidth, s = p.a.offsetWidth, b()), x = setTimeout(l, 50) }
                        }
                        var n = new c(h),
                            o = new c(h),
                            p = new c(h),
                            q = -1,
                            r = -1,
                            s = -1,
                            t = -1,
                            u = -1,
                            v = -1,
                            w = document.createElement("div"),
                            x = 0;
                        w.dir = "ltr", d(n, i(g, "sans-serif")), d(o, i(g, "serif")), d(p, i(g, "monospace")), w.appendChild(n.a), w.appendChild(o.a), w.appendChild(p.a), document.body.appendChild(w), t = n.a.offsetWidth, u = o.a.offsetWidth, v = p.a.offsetWidth, l(), f(n, function(a) { q = a, b() }), d(n, i(g, '"' + g.family + '",sans-serif')), f(o, function(a) { r = a, b() }), d(o, i(g, '"' + g.family + '",serif')), f(p, function(a) { s = a, b() }), d(p, i(g, '"' + g.family + '",monospace'))
                    })
                })
            }, "undefined" != typeof module ? module.exports = g : (window.FontFaceObserver = g, window.FontFaceObserver.prototype.load = g.prototype.load)
        }();
        var a = new FontFaceObserver("avenir-next-bold-condensed-subset");
        Promise.all([a.load()]).then(function() {
            document.documentElement.className += " fonts-stage-1";
            var a = new FontFaceObserver("avenir-next-regular"),
                b = new FontFaceObserver("avenir-next-bold-condensed"),
                c = new FontFaceObserver("avenir-next-bold");
            Promise.all([a.load(), b.load(), c.load()]).then(function() { document.documentElement.className += " fonts-stage-2", sessionStorage.criticalFoftDataUriFontsLoaded = !0 }).catch(function(a) { console.error(a) })
        })
    }();
} else {
    document.documentElement.className += " fonts-stage-1 fonts-stage-2";
}