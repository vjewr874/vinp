/*!
 * dashmix - v3.1.0
 * @author pixelcave - https://pixelcave.com
 * Copyright (c) 2020
 */
! function() {
    "use strict";

    function e(e, a) {
        for (var t = 0; t < a.length; t++) {
            var o = a[t];
            o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, o.key, o)
        }
    }
    var a = function() {
        function a() {
            ! function(e, a) {
                if (!(e instanceof a)) throw new TypeError("Cannot call a class as a function")
            }(this, a)
        }
        var t, o;
        return t = a, o = [{
            key: "updateTheme",
            value: function(e, a) {
                "default" === a ? e.length && e.remove() : e.length ? e.attr("href", a) : jQuery("#css-main").after('<link rel="stylesheet" id="css-theme" href="' + a + '">')
            }
        }, {
            key: "getWidth",
            value: function() {
                return window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth
            }
        }], null && e(t.prototype, null), o && e(t, o), a
    }();

    function t(e, a) {
        for (var t = 0; t < a.length; t++) {
            var o = a[t];
            o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, o.key, o)
        }
    }
    var o, n = !1,
        r = function() {
            function e() {
                ! function(e, a) {
                    if (!(e instanceof a)) throw new TypeError("Cannot call a class as a function")
                }(this, e)
            }
            var r, l;
            return r = e, null, (l = [{
                key: "run",
                value: function(e) {
                    var a = this,
                        t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
                        o = {
                            "core-bootstrap-tooltip": function() {
                                return a.coreBootstrapTooltip()
                            },
                            "core-bootstrap-popover": function() {
                                return a.coreBootstrapPopover()
                            },
                            "core-bootstrap-tabs": function() {
                                return a.coreBootstrapTabs()
                            },
                            "core-bootstrap-custom-file-input": function() {
                                return a.coreBootstrapCustomFileInput()
                            },
                            "core-toggle-class": function() {
                                return a.coreToggleClass()
                            },
                            "core-scroll-to": function() {
                                return a.coreScrollTo()
                            },
                            "core-year-copy": function() {
                                return a.coreYearCopy()
                            },
                            "core-appear": function() {
                                return a.coreAppear()
                            },
                            "core-ripple": function() {
                                return a.coreRipple()
                            },
                            print: function() {
                                return a.print()
                            },
                            "table-tools-sections": function() {
                                return a.tableToolsSections()
                            },
                            "table-tools-checkable": function() {
                                return a.tableToolsCheckable()
                            },
                            "magnific-popup": function() {
                                return a.magnific()
                            },
                            summernote: function() {
                                return a.summernote()
                            },
                            ckeditor: function() {
                                return a.ckeditor()
                            },
                            ckeditor5: function() {
                                return a.ckeditor5()
                            },
                            simplemde: function() {
                                return a.simpleMDE()
                            },
                            slick: function() {
                                return a.slick()
                            },
                            datepicker: function() {
                                return a.datepicker()
                            },
                            colorpicker: function() {
                                return a.colorpicker()
                            },
                            "masked-inputs": function() {
                                return a.maskedInputs()
                            },
                            select2: function() {
                                return a.select2()
                            },
                            highlightjs: function() {
                                return a.highlightjs()
                            },
                            notify: function(e) {
                                return a.notify(e)
                            },
                            "easy-pie-chart": function() {
                                return a.easyPieChart()
                            },
                            maxlength: function() {
                                return a.maxlength()
                            },
                            rangeslider: function() {
                                return a.rangeslider()
                            },
                            sparkline: function() {
                                return a.sparkline()
                            },
                            validation: function() {
                                return a.validation()
                            },
                            "pw-strength": function() {
                                return a.pwstrength()
                            },
                            flatpickr: function() {
                                return a.flatpickr()
                            }
                        };
                    if (e instanceof Array)
                        for (var n in e) o[e[n]] && o[e[n]](t);
                    else o[e] && o[e](t)
                }
            }, {
                key: "coreBootstrapTooltip",
                value: function() {
                    jQuery('[data-toggle="tooltip"]:not(.js-tooltip-enabled)').add(".js-tooltip:not(.js-tooltip-enabled)").each((function(e, a) {
                        var t = jQuery(a);
                        t.addClass("js-tooltip-enabled").tooltip({
                            container: t.data("container") || "body",
                            animation: t.data("animation") || !1
                        })
                    }))
                }
            }, {
                key: "coreBootstrapPopover",
                value: function() {
                    jQuery('[data-toggle="popover"]:not(.js-popover-enabled)').add(".js-popover:not(.js-popover-enabled)").each((function(e, a) {
                        var t = jQuery(a);
                        t.addClass("js-popover-enabled").popover({
                            container: t.data("container") || "body",
                            animation: t.data("animation") || !1,
                            trigger: t.data("trigger") || "hover focus"
                        })
                    }))
                }
            }, {
                key: "coreBootstrapTabs",
                value: function() {
                    jQuery('[data-toggle="tabs"]:not(.js-tabs-enabled)').add(".js-tabs:not(.js-tabs-enabled)").each((function(e, a) {
                        jQuery(a).addClass("js-tabs-enabled").find("a").on("click.pixelcave.helpers.core", (function(e) {
                            e.preventDefault(), jQuery(e.currentTarget).tab("show")
                        }))
                    }))
                }
            }, {
                key: "coreBootstrapCustomFileInput",
                value: function() {
                    jQuery('[data-toggle="custom-file-input"]:not(.js-custom-file-input-enabled)').each((function(e, a) {
                        var t = jQuery(a);
                        t.addClass("js-custom-file-input-enabled").on("change", (function(e) {
                            var a = e.target.files.length > 1 ? e.target.files.length + " " + (t.data("lang-files") || "Files") : e.target.files[0].name;
                            t.next(".custom-file-label").css("overflow-x", "hidden").html(a)
                        }))
                    }))
                }
            }, {
                key: "coreToggleClass",
                value: function() {
                    jQuery('[data-toggle="class-toggle"]:not(.js-class-toggle-enabled)').add(".js-class-toggle:not(.js-class-toggle-enabled)").on("click.pixelcave.helpers.core", (function(e) {
                        var a = jQuery(e.currentTarget);
                        a.addClass("js-class-toggle-enabled").trigger("blur"), jQuery(a.data("target").toString()).toggleClass(a.data("class").toString())
                    }))
                }
            }, {
                key: "coreScrollTo",
                value: function() {
                    jQuery('[data-toggle="scroll-to"]:not(.js-scroll-to-enabled)').on("click.pixelcave.helpers.core", (function(e) {
                        e.stopPropagation();
                        var a = jQuery("#page-header"),
                            t = jQuery(e.currentTarget),
                            o = t.data("target") || t.attr("href"),
                            n = t.data("speed") || 1e3,
                            r = a.length && jQuery("#page-container").hasClass("page-header-fixed") ? a.outerHeight() : 0;
                        t.addClass("js-scroll-to-enabled"), jQuery("html, body").animate({
                            scrollTop: jQuery(o).offset().top - r
                        }, n)
                    }))
                }
            }, {
                key: "coreYearCopy",
                value: function() {
                    var e = jQuery('[data-toggle="year-copy"]:not(.js-year-copy-enabled)');
                    if (e.length > 0) {
                        var a = (new Date).getFullYear(),
                            t = e.html().length > 0 ? e.html() : a;
                        e.addClass("js-year-copy-enabled").html(parseInt(t) >= a ? a : t + "-" + a.toString().substr(2, 2))
                    }
                }
            }, {
                key: "coreAppear",
                value: function() {
                    jQuery('[data-toggle="appear"]:not(.js-appear-enabled)').each((function(e, t) {
                        var o = a.getWidth(),
                            n = jQuery(t),
                            r = n.data("class") || "animated fadeIn",
                            l = n.data("offset") || 0,
                            i = o < 992 ? 0 : n.data("timeout") ? n.data("timeout") : 0;
                        n.addClass("js-appear-enabled").appear((function() {
                            setTimeout((function() {
                                n.removeClass("invisible").addClass(r)
                            }), i)
                        }), {
                            accY: l
                        })
                    }))
                }
            }, {
                key: "coreRipple",
                value: function() {
                    jQuery('[data-toggle="click-ripple"]:not(.js-click-ripple-enabled)').each((function(e, a) {
                        var t = jQuery(a);
                        t.addClass("js-click-ripple-enabled").css({
                            overflow: "hidden",
                            position: "relative",
                            "z-index": 1
                        }).on("click.pixelcave.helpers.core", (function(e) {
                            var a, o, n, r, l = "click-ripple";
                            0 === t.children("." + l).length ? t.prepend('<span class="click-ripple"></span>') : t.children("." + l).removeClass("animate"), (a = t.children("." + l)).height() || a.width() || (o = Math.max(t.outerWidth(), t.outerHeight()), a.css({
                                height: o,
                                width: o
                            })), n = e.pageX - t.offset().left - a.width() / 2, r = e.pageY - t.offset().top - a.height() / 2, a.css({
                                top: r + "px",
                                left: n + "px"
                            }).addClass("animate")
                        }))
                    }))
                }
            }, {
                key: "print",
                value: function() {
                    var e = jQuery("#page-container"),
                        a = e.prop("class");
                    e.prop("class", ""), window.print(), e.prop("class", a)
                }
            }, {
                key: "tableToolsSections",
                value: function() {
                    jQuery(".js-table-sections:not(.js-table-sections-enabled)").each((function(e, a) {
                        var t = jQuery(a);
                        t.addClass("js-table-sections-enabled"), jQuery(".js-table-sections-header > tr", t).on("click.pixelcave.helpers", (function(e) {
                            if (!("checkbox" === e.target.type || "button" === e.target.type || "a" === e.target.tagName.toLowerCase() || jQuery(e.target).parent("a").length || jQuery(e.target).parent("button").length || jQuery(e.target).parent(".custom-control").length || jQuery(e.target).parent("label").length)) {
                                var a = jQuery(e.currentTarget).parent("tbody");
                                a.hasClass("show") || jQuery("tbody", t).removeClass("show table-active"), a.toggleClass("show table-active")
                            }
                        }))
                    }))
                }
            }, {
                key: "tableToolsCheckable",
                value: function() {
                    var e = this;
                    jQuery(".js-table-checkable:not(.js-table-checkable-enabled)").each((function(a, t) {
                        var o = jQuery(t);
                        o.addClass("js-table-checkable-enabled"), jQuery("thead input:checkbox", o).on("click.pixelcave.helpers", (function(a) {
                            var t = jQuery(a.currentTarget).prop("checked");
                            jQuery("tbody input:checkbox", o).each((function(a, o) {
                                var n = jQuery(o);
                                n.prop("checked", t).change(), e.tableToolscheckRow(n, t)
                            }))
                        })), jQuery("tbody input:checkbox, tbody input + label", o).on("click.pixelcave.helpers", (function(a) {
                            var t = jQuery(a.currentTarget);
                            t.prop("checked") ? jQuery("tbody input:checkbox:checked", o).length === jQuery("tbody input:checkbox", o).length && jQuery("thead input:checkbox", o).prop("checked", !0) : jQuery("thead input:checkbox", o).prop("checked", !1), e.tableToolscheckRow(t, t.prop("checked"))
                        })), jQuery("tbody > tr", o).on("click.pixelcave.helpers", (function(a) {
                            if (!("checkbox" === a.target.type || "button" === a.target.type || "a" === a.target.tagName.toLowerCase() || jQuery(a.target).parent("a").length || jQuery(a.target).parent("button").length || jQuery(a.target).parent(".custom-control").length || jQuery(a.target).parent("label").length)) {
                                var t = jQuery("input:checkbox", a.currentTarget),
                                    n = t.prop("checked");
                                t.prop("checked", !n).change(), e.tableToolscheckRow(t, !n), n ? jQuery("thead input:checkbox", o).prop("checked", !1) : jQuery("tbody input:checkbox:checked", o).length === jQuery("tbody input:checkbox", o).length && jQuery("thead input:checkbox", o).prop("checked", !0)
                            }
                        }))
                    }))
                }
            }, {
                key: "tableToolscheckRow",
                value: function(e, a) {
                    a ? e.closest("tr").addClass("table-active") : e.closest("tr").removeClass("table-active")
                }
            }, {
                key: "magnific",
                value: function() {
                    jQuery(".js-gallery:not(.js-gallery-enabled)").each((function(e, a) {
                        jQuery(a).addClass("js-gallery-enabled").magnificPopup({
                            delegate: "a.img-lightbox",
                            type: "image",
                            gallery: {
                                enabled: !0
                            }
                        })
                    }))
                }
            }, {
                key: "summernote",
                value: function() {
                    jQuery(".js-summernote-air:not(.js-summernote-air-enabled)").each((function(e, a) {
                        jQuery(a).addClass("js-summernote-air-enabled").summernote({
                            airMode: !0,
                            tooltip: !1
                        })
                    })), jQuery(".js-summernote:not(.js-summernote-enabled)").each((function(e, a) {
                        var t = jQuery(a);
                        t.addClass("js-summernote-enabled").summernote({
                            height: t.data("height") || 350,
                            minHeight: t.data("min-height") || null,
                            maxHeight: t.data("max-height") || null
                        })
                    }))
                }
            }, {
                key: "ckeditor",
                value: function() {
                    jQuery("#js-ckeditor-inline:not(.js-ckeditor-inline-enabled)").length && (jQuery("#js-ckeditor-inline").attr("contenteditable", "true"), CKEDITOR.inline("js-ckeditor-inline"), jQuery("#js-ckeditor-inline").addClass("js-ckeditor-inline-enabled")), jQuery("#js-ckeditor:not(.js-ckeditor-enabled)").length && (CKEDITOR.replace("js-ckeditor"), jQuery("#js-ckeditor").addClass("js-ckeditor-enabled"))
                }
            }, {
                key: "ckeditor5",
                value: function() {
                    jQuery("#js-ckeditor5-inline:not(.js-ckeditor5-inline-enabled)").length && (InlineEditor.create(document.querySelector("#js-ckeditor5-inline")).then((function(e) {
                        window.editor = e
                    })).catch((function(e) {
                        console.error("There was a problem initializing the inline editor.", e)
                    })), jQuery("#js-ckeditor5-inline").addClass("js-ckeditor5-inline-enabled")), jQuery("#js-ckeditor5-classic:not(.js-ckeditor5-classic-enabled)").length && (ClassicEditor.create(document.querySelector("#js-ckeditor5-classic")).then((function(e) {
                        window.editor = e
                    })).catch((function(e) {
                        console.error("There was a problem initializing the classic editor.", e)
                    })), jQuery("#js-ckeditor5-classic").addClass("js-ckeditor5-classic-enabled"))
                }
            }, {
                key: "simpleMDE",
                value: function() {
                    jQuery(".js-simplemde:not(.js-simplemde-enabled)").each((function(e, a) {
                        var t = jQuery(a);
                        t.addClass("js-simplemde-enabled"), new SimpleMDE({
                            element: t[0],
                            autoDownloadFontAwesome: !1
                        })
                    }))
                }
            }, {
                key: "slick",
                value: function() {
                    jQuery(".js-slider:not(.js-slider-enabled)").each((function(e, a) {
                        var t = jQuery(a);
                        t.addClass("js-slider-enabled").slick({
                            arrows: t.data("arrows") || !1,
                            dots: t.data("dots") || !1,
                            slidesToShow: t.data("slides-to-show") || 1,
                            centerMode: t.data("center-mode") || !1,
                            autoplay: t.data("autoplay") || !1,
                            autoplaySpeed: t.data("autoplay-speed") || 3e3,
                            infinite: void 0 === t.data("infinite") || t.data("infinite")
                        })
                    }))
                }
            }, {
                key: "datepicker",
                value: function() {
                    jQuery(".js-datepicker:not(.js-datepicker-enabled)").add(".input-daterange:not(.js-datepicker-enabled)").each((function(e, a) {
                        var t = jQuery(a);
                        t.addClass("js-datepicker-enabled").datepicker({
                            weekStart: t.data("week-start") || 0,
                            autoclose: t.data("autoclose") || !1,
                            todayHighlight: t.data("today-highlight") || !1,
                            orientation: "bottom"
                        })
                    }))
                }
            }, {
                key: "colorpicker",
                value: function() {
                    jQuery(".js-colorpicker:not(.js-colorpicker-enabled)").each((function(e, a) {
                        jQuery(a).addClass("js-colorpicker-enabled").colorpicker()
                    }))
                }
            }, {
                key: "maskedInputs",
                value: function() {
                    jQuery(".js-masked-date:not(.js-masked-enabled)").mask("99/99/9999"), jQuery(".js-masked-date-dash:not(.js-masked-enabled)").mask("99-99-9999"), jQuery(".js-masked-phone:not(.js-masked-enabled)").mask("(999) 999-9999"), jQuery(".js-masked-phone-ext:not(.js-masked-enabled)").mask("(999) 999-9999? x99999"), jQuery(".js-masked-taxid:not(.js-masked-enabled)").mask("99-9999999"), jQuery(".js-masked-ssn:not(.js-masked-enabled)").mask("999-99-9999"), jQuery(".js-masked-pkey:not(.js-masked-enabled)").mask("a*-999-a999"), jQuery(".js-masked-time:not(.js-masked-enabled)").mask("99:99"), jQuery(".js-masked-date").add(".js-masked-date-dash").add(".js-masked-phone").add(".js-masked-phone-ext").add(".js-masked-taxid").add(".js-masked-ssn").add(".js-masked-pkey").add(".js-masked-time").addClass("js-masked-enabled")
                }
            }, {
                key: "select2",
                value: function() {
                    jQuery(".js-select2:not(.js-select2-enabled)").each((function(e, a) {
                        var t = jQuery(a);
                        t.addClass("js-select2-enabled").select2({
                            placeholder: t.data("placeholder") || !1
                        })
                    }))
                }
            }, {
                key: "highlightjs",
                value: function() {
                    hljs.isHighlighted || hljs.initHighlighting()
                }
            }, {
                key: "notify",
                value: function() {
                    var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
                    jQuery.isEmptyObject(e) ? jQuery(".js-notify:not(.js-notify-enabled)").each((function(e, a) {
                        jQuery(a).addClass("js-notify-enabled").on("click.pixelcave.helpers", (function(e) {
                            var a = jQuery(e.currentTarget);
                            jQuery.notify({
                                icon: a.data("icon") || "",
                                message: a.data("message"),
                                url: a.data("url") || ""
                            }, {
                                element: "body",
                                type: a.data("type") || "info",
                                placement: {
                                    from: a.data("from") || "top",
                                    align: a.data("align") || "right"
                                },
                                allow_dismiss: !0,
                                newest_on_top: !0,
                                showProgressbar: !1,
                                offset: 20,
                                spacing: 10,
                                z_index: 1033,
                                delay: 5e3,
                                timer: 1e3,
                                animate: {
                                    enter: "animated fadeIn",
                                    exit: "animated fadeOutDown"
                                }
                            })
                        }))
                    })) : jQuery.notify({
                        icon: e.icon || "",
                        message: e.message,
                        url: e.url || ""
                    }, {
                        element: e.element || "body",
                        type: e.type || "info",
                        placement: {
                            from: e.from || "top",
                            align: e.align || "right"
                        },
                        allow_dismiss: !1 !== e.allow_dismiss,
                        newest_on_top: !1 !== e.newest_on_top,
                        showProgressbar: !!e.show_progress_bar,
                        offset: e.offset || 20,
                        spacing: e.spacing || 10,
                        z_index: e.z_index || 1033,
                        delay: e.delay || 5e3,
                        timer: e.timer || 1e3,
                        animate: {
                            enter: e.animate_enter || "animated fadeIn",
                            exit: e.animate_exit || "animated fadeOutDown"
                        }
                    })
                }
            }, {
                key: "easyPieChart",
                value: function() {
                    jQuery(".js-pie-chart:not(.js-pie-chart-enabled)").each((function(e, a) {
                        var t = jQuery(a);
                        t.addClass("js-pie-chart-enabled").easyPieChart({
                            barColor: t.data("bar-color") || "#777777",
                            trackColor: t.data("track-color") || "#eeeeee",
                            lineWidth: t.data("line-width") || 3,
                            size: t.data("size") || "80",
                            animate: t.data("animate") || 750,
                            scaleColor: t.data("scale-color") || !1
                        })
                    }))
                }
            }, {
                key: "maxlength",
                value: function() {
                    jQuery(".js-maxlength:not(.js-maxlength-enabled)").each((function(e, a) {
                        var t = jQuery(a);
                        t.addClass("js-maxlength-enabled").maxlength({
                            alwaysShow: !!t.data("always-show"),
                            threshold: t.data("threshold") || 10,
                            warningClass: t.data("warning-class") || "badge badge-warning",
                            limitReachedClass: t.data("limit-reached-class") || "badge badge-danger",
                            placement: t.data("placement") || "bottom",
                            preText: t.data("pre-text") || "",
                            separator: t.data("separator") || "/",
                            postText: t.data("post-text") || ""
                        })
                    }))
                }
            }, {
                key: "rangeslider",
                value: function() {
                    jQuery(".js-rangeslider:not(.js-rangeslider-enabled)").each((function(e, a) {
                        var t = jQuery(a);
                        jQuery(a).addClass("js-rangeslider-enabled").ionRangeSlider({
                            input_values_separator: ";",
                            skin: t.data("skin") || "round"
                        })
                    }))
                }
            }, {
                key: "sparkline",
                value: function() {
                    var e = this;
                    jQuery(".js-sparkline:not(.js-sparkline-enabled)").each((function(a, t) {
                        var r = jQuery(t),
                            l = r.data("type"),
                            i = {},
                            s = {
                                line: function() {
                                    i.type = l, i.lineWidth = r.data("line-width") || 2, i.lineColor = r.data("line-color") || "#0665d0", i.fillColor = r.data("fill-color") || "#0665d0", i.spotColor = r.data("spot-color") || "#495057", i.minSpotColor = r.data("min-spot-color") || "#495057", i.maxSpotColor = r.data("max-spot-color") || "#495057", i.highlightSpotColor = r.data("highlight-spot-color") || "#495057", i.highlightLineColor = r.data("highlight-line-color") || "#495057", i.spotRadius = r.data("spot-radius") || 2, i.tooltipFormat = "{{prefix}}{{y}}{{suffix}}"
                                },
                                bar: function() {
                                    i.type = l, i.barWidth = r.data("bar-width") || 8, i.barSpacing = r.data("bar-spacing") || 6, i.barColor = r.data("bar-color") || "#0665d0", i.tooltipFormat = "{{prefix}}{{value}}{{suffix}}"
                                },
                                pie: function() {
                                    i.type = l, i.sliceColors = ["#ffb119", "#8dc451", "#3c90df", "#e04f1a"], i.highlightLighten = r.data("highlight-lighten") || 1.1, i.tooltipFormat = "{{prefix}}{{value}}{{suffix}}"
                                },
                                tristate: function() {
                                    i.type = l, i.barWidth = r.data("bar-width") || 8, i.barSpacing = r.data("bar-spacing") || 6, i.posBarColor = r.data("pos-bar-color") || "#82b54b", i.negBarColor = r.data("neg-bar-color") || "#e04f1a"
                                }
                            };
                        s[l] ? (s[l](), "line" === l && ((r.data("chart-range-min") >= 0 || r.data("chart-range-min")) && (i.chartRangeMin = r.data("chart-range-min")), (r.data("chart-range-max") >= 0 || r.data("chart-range-max")) && (i.chartRangeMax = r.data("chart-range-max"))), i.width = r.data("width") || "120px", i.height = r.data("height") || "80px", i.tooltipPrefix = r.data("tooltip-prefix") ? r.data("tooltip-prefix") + " " : "", i.tooltipSuffix = r.data("tooltip-suffix") ? " " + r.data("tooltip-suffix") : "", "100%" === i.width ? n || (n = !0, jQuery(window).on("resize.pixelcave.helpers.sparkline", (function(a) {
                            clearTimeout(o), o = setTimeout((function() {
                                e.sparkline()
                            }), 500)
                        }))) : jQuery(t).addClass("js-sparkline-enabled"), jQuery(t).sparkline(r.data("points") || [0], i)) : console.log("[jQuery Sparkline JS Helper] Please add a correct type (line, bar, pie or tristate) in all your elements with 'js-sparkline' class.")
                    }))
                }
            }, {
                key: "validation",
                value: function() {
                    jQuery.validator.setDefaults({
                        errorClass: "invalid-feedback animated fadeIn",
                        errorElement: "div",
                        errorPlacement: function(e, a) {
                            jQuery(a).addClass("is-invalid"), jQuery(a).parents(".form-group").append(e)
                        },
                        highlight: function(e) {
                            jQuery(e).parents(".form-group").find(".is-invalid").removeClass("is-invalid").addClass("is-invalid")
                        },
                        success: function(e) {
                            jQuery(e).parents(".form-group").find(".is-invalid").removeClass("is-invalid"), jQuery(e).remove()
                        }
                    })
                }
            }, {
                key: "pwstrength",
                value: function() {
                    jQuery(".js-pw-strength:not(.js-pw-strength-enabled)").each((function(e, a) {
                        var t = jQuery(a),
                            o = t.parents(".js-pw-strength-container"),
                            n = jQuery(".js-pw-strength-progress", o),
                            r = jQuery(".js-pw-strength-feedback", o);
                        t.addClass("js-pw-strength-enabled").pwstrength({
                            ui: {
                                container: o,
                                viewports: {
                                    progress: n,
                                    verdict: r
                                }
                            }
                        })
                    }))
                }
            }, {
                key: "flatpickr",
                value: function(e) {
                    function a() {
                        return e.apply(this, arguments)
                    }
                    return a.toString = function() {
                        return e.toString()
                    }, a
                }((function() {
                    jQuery(".js-flatpickr:not(.js-flatpickr-enabled)").each((function(e, a) {
                        var t = jQuery(a);
                        t.addClass("js-flatpickr-enabled"), flatpickr(t, {})
                    }))
                }))
            }]) && t(r, l), e
        }();

    function l(e, a) {
        for (var t = 0; t < a.length; t++) {
            var o = a[t];
            o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, o.key, o)
        }
    }

    function i(e) {
        return (i = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
            return typeof e
        } : function(e) {
            return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
        })(e)
    }

    function s(e, a) {
        return (s = Object.setPrototypeOf || function(e, a) {
            return e.__proto__ = a, e
        })(e, a)
    }

    function c(e, a) {
        return !a || "object" !== i(a) && "function" != typeof a ? function(e) {
            if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
            return e
        }(e) : a
    }

    function d(e) {
        return (d = Object.setPrototypeOf ? Object.getPrototypeOf : function(e) {
            return e.__proto__ || Object.getPrototypeOf(e)
        })(e)
    }
    var u = function(e) {
        ! function(e, a) {
            if ("function" != typeof a && null !== a) throw new TypeError("Super expression must either be null or a function");
            e.prototype = Object.create(a && a.prototype, {
                constructor: {
                    value: e,
                    writable: !0,
                    configurable: !0
                }
            }), a && s(e, a)
        }(n, e);
        var a, t, o = (a = n, t = function() {
            if ("undefined" == typeof Reflect || !Reflect.construct) return !1;
            if (Reflect.construct.sham) return !1;
            if ("function" == typeof Proxy) return !0;
            try {
                return Date.prototype.toString.call(Reflect.construct(Date, [], (function() {}))), !0
            } catch (e) {
                return !1
            }
        }(), function() {
            var e, o = d(a);
            if (t) {
                var n = d(this).constructor;
                e = Reflect.construct(o, arguments, n)
            } else e = o.apply(this, arguments);
            return c(this, e)
        });

        function n() {
            return function(e, a) {
                if (!(e instanceof a)) throw new TypeError("Cannot call a class as a function")
            }(this, n), o.call(this)
        }
        return n
    }(function() {
        function e() {
            ! function(e, a) {
                if (!(e instanceof a)) throw new TypeError("Cannot call a class as a function")
            }(this, e), this._uiInit()
        }
        var t, o;
        return t = e, (o = [{
            key: "_uiInit",
            value: function() {
                this._lHtml = jQuery("html"), this._lBody = jQuery("body"), this._lpageLoader = jQuery("#page-loader"), this._lPage = jQuery("#page-container"), this._lSidebar = jQuery("#sidebar"), this._lSidebarScrollCon = jQuery(".js-sidebar-scroll", "#sidebar"), this._lSideOverlay = jQuery("#side-overlay"), this._lHeader = jQuery("#page-header"), this._lHeaderSearch = jQuery("#page-header-search"), this._lHeaderSearchInput = jQuery("#page-header-search-input"), this._lHeaderLoader = jQuery("#page-header-loader"), this._lMain = jQuery("#main-container"), this._lFooter = jQuery("#page-footer"), this._lSidebarScroll = !1, this._lSideOverlayScroll = !1, this._windowW = a.getWidth(), this._uiHandleSidebars("init"), this._uiHandleHeader(), this._uiHandleNav(), this._uiHandleTheme(), this._uiApiLayout(), this._uiApiBlocks(), this.helpers(["core-bootstrap-tooltip", "core-bootstrap-popover", "core-bootstrap-tabs", "core-bootstrap-custom-file-input", "core-toggle-class", "core-scroll-to", "core-year-copy", "core-appear", "core-ripple"]), this._uiHandlePageLoader()
            }
        }, {
            key: "_uiHandleSidebars",
            value: function(e) {
                var a = this;
                "init" === e ? (a._lPage.addClass("side-trans-enabled"), this._uiHandleSidebars()) : a._lPage.hasClass("side-scroll") ? (a._lSidebar.length > 0 && !a._lSidebarScroll && (a._lSidebarScroll = new SimpleBar(a._lSidebarScrollCon[0]), jQuery(".simplebar-content-wrapper", a._lSidebar).scrollLock("enable")), a._lSideOverlay.length > 0 && !a._lSideOverlayScroll && (a._lSideOverlayScroll = new SimpleBar(a._lSideOverlay[0]), jQuery(".simplebar-content-wrapper", a._lSideOverlay).scrollLock("enable"))) : (a._lSidebar && a._lSidebarScroll && (jQuery(".simplebar-content-wrapper", a._lSidebar).scrollLock("disable"), a._lSidebarScroll.unMount(), a._lSidebarScroll = null, a._lSidebarScrollCon.removeAttr("data-simplebar").html(jQuery(".simplebar-content", a._lSidebar).html())), a._lSideOverlay && a._lSideOverlayScroll && (jQuery(".simplebar-content-wrapper", a._lSideOverlay).scrollLock("disable"), a._lSideOverlayScroll.unMount(), a._lSideOverlayScroll = null, a._lSideOverlay.removeAttr("data-simplebar").html(jQuery(".simplebar-content", a._lSideOverlay).html())))
            }
        }, {
            key: "_uiHandleHeader",
            value: function() {
                var e = this;
                jQuery(window).off("scroll.pixelcave.header"), e._lPage.hasClass("page-header-glass") && e._lPage.hasClass("page-header-fixed") && jQuery(window).on("scroll.pixelcave.header", (function(a) {
                    jQuery(a.currentTarget).scrollTop() > 60 ? e._lPage.addClass("page-header-scroll") : e._lPage.removeClass("page-header-scroll")
                })).trigger("scroll.pixelcave.header")
            }
        }, {
            key: "_uiHandleNav",
            value: function() {
                this._lPage.off("click.pixelcave.menu"), this._lPage.on("click.pixelcave.menu", '[data-toggle="submenu"]', (function(e) {
                    var t = jQuery(e.currentTarget);
                    if (!(a.getWidth() > 991 && t.parents(".nav-main").hasClass("nav-main-horizontal nav-main-hover"))) {
                        var o = t.parent("li");
                        o.hasClass("open") ? (o.removeClass("open"), t.attr("aria-expanded", "false")) : (t.closest("ul").children("li").removeClass("open"), o.addClass("open"), t.attr("aria-expanded", "true")), t.trigger("blur")
                    }
                    return !1
                }))
            }
        }, {
            key: "_uiHandlePageLoader",
            value: function() {
                var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "hide",
                    a = arguments.length > 1 ? arguments[1] : void 0;
                "show" === e ? this._lpageLoader.length ? (a && this._lpageLoader.removeClass().addClass(a), this._lpageLoader.addClass("show")) : this._lBody.prepend('<div id="page-loader" class="show'.concat(a ? " " + a : "", '"></div>')) : "hide" === e && this._lpageLoader.length && this._lpageLoader.removeClass("show")
            }
        }, {
            key: "_uiHandleTheme",
            value: function() {
                var e = jQuery("#css-theme"),
                    t = !!this._lPage.hasClass("enable-cookies");
                if (t) {
                    var o = Cookies.get("dashmixThemeName") || !1;
                    o && a.updateTheme(e, o), e = jQuery("#css-theme")
                }
                jQuery('[data-toggle="theme"][data-theme="' + (e.length ? e.attr("href") : "default") + '"]').addClass("active"), this._lPage.off("click.pixelcave.themes"), this._lPage.on("click.pixelcave.themes", '[data-toggle="theme"]', (function(o) {
                    o.preventDefault();
                    var n = jQuery(o.currentTarget),
                        r = n.data("theme");
                    jQuery('[data-toggle="theme"]').removeClass("active"), jQuery('[data-toggle="theme"][data-theme="' + r + '"]').addClass("active"), a.updateTheme(e, r), e = jQuery("#css-theme"), t && Cookies.set("dashmixThemeName", r, {
                        expires: 7
                    }), n.trigger("blur")
                }))
            }
        }, {
            key: "_uiApiLayout",
            value: function() {
                var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "init",
                    t = this;
                t._windowW = a.getWidth();
                var o = {
                    init: function() {
                        t._lPage.off("click.pixelcave.layout"), t._lPage.off("click.pixelcave.overlay"), t._lPage.on("click.pixelcave.layout", '[data-toggle="layout"]', (function(e) {
                            var a = jQuery(e.currentTarget);
                            t._uiApiLayout(a.data("action")), a.trigger("blur")
                        })), t._lPage.hasClass("enable-page-overlay") && (t._lPage.prepend('<div id="page-overlay"></div>'), jQuery("#page-overlay").on("click.pixelcave.overlay", (function(e) {
                            t._uiApiLayout("side_overlay_close")
                        })))
                    },
                    sidebar_pos_toggle: function() {
                        t._lPage.toggleClass("sidebar-r")
                    },
                    sidebar_pos_left: function() {
                        t._lPage.removeClass("sidebar-r")
                    },
                    sidebar_pos_right: function() {
                        t._lPage.addClass("sidebar-r")
                    },
                    sidebar_toggle: function() {
                        t._windowW > 991 ? t._lPage.toggleClass("sidebar-o") : t._lPage.toggleClass("sidebar-o-xs")
                    },
                    sidebar_open: function() {
                        t._windowW > 991 ? t._lPage.addClass("sidebar-o") : t._lPage.addClass("sidebar-o-xs")
                    },
                    sidebar_close: function() {
                        t._windowW > 991 ? t._lPage.removeClass("sidebar-o") : t._lPage.removeClass("sidebar-o-xs")
                    },
                    sidebar_mini_toggle: function() {
                        t._windowW > 991 && t._lPage.toggleClass("sidebar-mini")
                    },
                    sidebar_mini_on: function() {
                        t._windowW > 991 && t._lPage.addClass("sidebar-mini")
                    },
                    sidebar_mini_off: function() {
                        t._windowW > 991 && t._lPage.removeClass("sidebar-mini")
                    },
                    sidebar_style_toggle: function() {
                        t._lPage.toggleClass("sidebar-dark")
                    },
                    sidebar_style_dark: function() {
                        t._lPage.addClass("sidebar-dark")
                    },
                    sidebar_style_light: function() {
                        t._lPage.removeClass("sidebar-dark")
                    },
                    side_overlay_toggle: function() {
                        t._lPage.hasClass("side-overlay-o") ? t._uiApiLayout("side_overlay_close") : t._uiApiLayout("side_overlay_open")
                    },
                    side_overlay_open: function() {
                        jQuery(document).on("keydown.pixelcave.sideOverlay", (function(e) {
                            27 === e.which && (e.preventDefault(), t._uiApiLayout("side_overlay_close"))
                        })), t._lPage.addClass("side-overlay-o")
                    },
                    side_overlay_close: function() {
                        jQuery(document).off("keydown.pixelcave.sideOverlay"), t._lPage.removeClass("side-overlay-o")
                    },
                    side_overlay_mode_hover_toggle: function() {
                        t._lPage.toggleClass("side-overlay-hover")
                    },
                    side_overlay_mode_hover_on: function() {
                        t._lPage.addClass("side-overlay-hover")
                    },
                    side_overlay_mode_hover_off: function() {
                        t._lPage.removeClass("side-overlay-hover")
                    },
                    header_mode_toggle: function() {
                        t._lPage.toggleClass("page-header-fixed"), t._uiHandleHeader()
                    },
                    header_mode_static: function() {
                        t._lPage.removeClass("page-header-fixed"), t._uiHandleHeader()
                    },
                    header_mode_fixed: function() {
                        t._lPage.addClass("page-header-fixed"), t._uiHandleHeader()
                    },
                    header_glass_toggle: function() {
                        t._lPage.toggleClass("page-header-glass"), t._uiHandleHeader()
                    },
                    header_glass_on: function() {
                        t._lPage.addClass("page-header-glass"), t._uiHandleHeader()
                    },
                    header_glass_off: function() {
                        t._lPage.removeClass("page-header-glass"), t._uiHandleHeader()
                    },
                    header_style_toggle: function() {
                        t._lPage.toggleClass("page-header-dark")
                    },
                    header_style_dark: function() {
                        t._lPage.addClass("page-header-dark")
                    },
                    header_style_light: function() {
                        t._lPage.removeClass("page-header-dark")
                    },
                    header_search_on: function() {
                        t._lHeaderSearch.addClass("show"), t._lHeaderSearchInput.focus(), jQuery(document).on("keydown.pixelcave.header.search", (function(e) {
                            27 === e.which && (e.preventDefault(), t._uiApiLayout("header_search_off"))
                        }))
                    },
                    header_search_off: function() {
                        t._lHeaderSearch.removeClass("show"), t._lHeaderSearchInput.trigger("blur"), jQuery(document).off("keydown.pixelcave.header.search")
                    },
                    header_loader_on: function() {
                        t._lHeaderLoader.addClass("show")
                    },
                    header_loader_off: function() {
                        t._lHeaderLoader.removeClass("show")
                    },
                    footer_mode_toggle: function() {
                        t._lPage.toggleClass("page-footer-fixed")
                    },
                    footer_mode_static: function() {
                        t._lPage.removeClass("page-footer-fixed")
                    },
                    footer_mode_fixed: function() {
                        t._lPage.addClass("page-footer-fixed")
                    },
                    side_scroll_toggle: function() {
                        t._lPage.toggleClass("side-scroll"), t._uiHandleSidebars()
                    },
                    side_scroll_native: function() {
                        t._lPage.removeClass("side-scroll"), t._uiHandleSidebars()
                    },
                    side_scroll_custom: function() {
                        t._lPage.addClass("side-scroll"), t._uiHandleSidebars()
                    },
                    content_layout_toggle: function() {
                        t._lPage.hasClass("main-content-boxed") ? t._uiApiLayout("content_layout_narrow") : t._lPage.hasClass("main-content-narrow") ? t._uiApiLayout("content_layout_full_width") : t._uiApiLayout("content_layout_boxed")
                    },
                    content_layout_boxed: function() {
                        t._lPage.removeClass("main-content-narrow").addClass("main-content-boxed")
                    },
                    content_layout_narrow: function() {
                        t._lPage.removeClass("main-content-boxed").addClass("main-content-narrow")
                    },
                    content_layout_full_width: function() {
                        t._lPage.removeClass("main-content-boxed main-content-narrow")
                    }
                };
                o[e] && o[e]()
            }
        }, {
            key: "_uiApiBlocks",
            value: function() {
                var e, a, t, o = this,
                    n = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "init",
                    r = arguments.length > 1 && void 0 !== arguments[1] && arguments[1],
                    l = this,
                    i = "si si-size-fullscreen",
                    s = "si si-size-actual",
                    c = "si si-arrow-up",
                    d = "si si-arrow-down",
                    u = {
                        init: function() {
                            jQuery('[data-toggle="block-option"][data-action="fullscreen_toggle"]').each((function(e, a) {
                                var t = jQuery(a);
                                t.html('<i class="' + (jQuery(t).closest(".block").hasClass("block-mode-fullscreen") ? s : i) + '"></i>')
                            })), jQuery('[data-toggle="block-option"][data-action="content_toggle"]').each((function(e, a) {
                                var t = jQuery(a);
                                t.html('<i class="' + (t.closest(".block").hasClass("block-mode-hidden") ? d : c) + '"></i>')
                            })), l._lPage.off("click.pixelcave.blocks"), l._lPage.on("click.pixelcave.blocks", '[data-toggle="block-option"]', (function(e) {
                                o._uiApiBlocks(jQuery(e.currentTarget).data("action"), jQuery(e.currentTarget).closest(".block"))
                            }))
                        },
                        fullscreen_toggle: function() {
                            e.removeClass("block-mode-pinned").toggleClass("block-mode-fullscreen"), e.hasClass("block-mode-fullscreen") ? jQuery(e).scrollLock("enable") : jQuery(e).scrollLock("disable"), a.length && (e.hasClass("block-mode-fullscreen") ? jQuery("i", a).removeClass(i).addClass(s) : jQuery("i", a).removeClass(s).addClass(i))
                        },
                        fullscreen_on: function() {
                            e.removeClass("block-mode-pinned").addClass("block-mode-fullscreen"), jQuery(e).scrollLock("enable"), a.length && jQuery("i", a).removeClass(i).addClass(s)
                        },
                        fullscreen_off: function() {
                            e.removeClass("block-mode-fullscreen"), jQuery(e).scrollLock("disable"), a.length && jQuery("i", a).removeClass(s).addClass(i)
                        },
                        content_toggle: function() {
                            e.toggleClass("block-mode-hidden"), t.length && (e.hasClass("block-mode-hidden") ? jQuery("i", t).removeClass(c).addClass(d) : jQuery("i", t).removeClass(d).addClass(c))
                        },
                        content_hide: function() {
                            e.addClass("block-mode-hidden"), t.length && jQuery("i", t).removeClass(c).addClass(d)
                        },
                        content_show: function() {
                            e.removeClass("block-mode-hidden"), t.length && jQuery("i", t).removeClass(d).addClass(c)
                        },
                        state_toggle: function() {
                            e.toggleClass("block-mode-loading"), jQuery('[data-toggle="block-option"][data-action="state_toggle"][data-action-mode="demo"]', e).length && setTimeout((function() {
                                e.removeClass("block-mode-loading")
                            }), 2e3)
                        },
                        state_loading: function() {
                            e.addClass("block-mode-loading")
                        },
                        state_normal: function() {
                            e.removeClass("block-mode-loading")
                        },
                        pinned_toggle: function() {
                            e.removeClass("block-mode-fullscreen").toggleClass("block-mode-pinned")
                        },
                        pinned_on: function() {
                            e.removeClass("block-mode-fullscreen").addClass("block-mode-pinned")
                        },
                        pinned_off: function() {
                            e.removeClass("block-mode-pinned")
                        },
                        close: function() {
                            e.addClass("d-none")
                        },
                        open: function() {
                            e.removeClass("d-none")
                        }
                    };
                "init" === n ? u[n]() : (e = r instanceof jQuery ? r : jQuery(r)).length && (a = jQuery('[data-toggle="block-option"][data-action="fullscreen_toggle"]', e), t = jQuery('[data-toggle="block-option"][data-action="content_toggle"]', e), u[n] && u[n]())
            }
        }, {
            key: "init",
            value: function() {
                this._uiInit()
            }
        }, {
            key: "layout",
            value: function(e) {
                this._uiApiLayout(e)
            }
        }, {
            key: "block",
            value: function(e, a) {
                this._uiApiBlocks(e, a)
            }
        }, {
            key: "loader",
            value: function(e, a) {
                this._uiHandlePageLoader(e, a)
            }
        }, {
            key: "helpers",
            value: function(e) {
                var a = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
                r.run(e, a)
            }
        }]) && l(t.prototype, o), e
    }());
    jQuery((function() {
        window.Dashmix = new u
    }))
}();