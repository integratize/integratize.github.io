/*
| ------------------------------------------------------------------------------
| JDocument
| ------------------------------------------------------------------------------
*/
class JDocument {

    /**
     * Class constructor
     *
     * @access public
     */
    constructor() {
        this.doc                   = document;
        this.doc.lang              = this.doc.documentElement.lang;
        this.doc.ready             = cb => this.ready(cb);
        this.doc.on                = (...args) => this.on(args);
        this.doc.parser            = data => this.parser(data);
        this.doc.html              = data => this.html(data);
        this.doc.height            = () => this.height();
        this.doc.width             = () => this.width();
        this.doc.resizeScreen      = () => this.resizeScreen();
        this.doc.windowResizeEvent = cb => this.windowResizeEvent(cb);
        this.doc.error             = cb => this.error(cb);
        return this.doc;
    }

    /**
     * DOM content loaded
     *
     * ready(function (e) {
     *
     * });
     *
     * @param {Callback} callback
     * @access public
     */
    ready(callback) {
        this.doc.addEventListener("DOMContentLoaded", function (e) {
            callback(e);
        });
    }

    /**
     * Add event listener
     *
     * on("click", function (e) {
     *
     * });
     *
     * on("click", "#id", function (e) {
     *
     * });
     *
     * @param {Array} args
     * @access public
     */
    on(args) {
        if (typeof args[1] === "string") {
            $(document).on(args[0], args[1], function (e) {
                args[2](e);
            });
        } else {
            this.doc.addEventListener(args[0], function (e) {
                args[1](e);
            });
        }
    }

    /**

     * Convert this string into a dom element.
     *
     * const doc = $_["document"].parser("<html>...</html>");
     * console.log(doc.getElementsByTagName("body")[0]);
     *
     * @param {String} data
     * @access public
     */
    parser(data) {
        const parser = new DOMParser();
        return parser.parseFromString(data, "text/html");
    }

    /**

     * Overwrite current document with HTML data
     *
     * @param {String} data
     * @access public
     */
    html(data) {
        this.doc.documentElement.innerHTML = data;
    }

    /**
     * Get document height
     *
     * @access public
     */
    height() {
        return window.innerHeight ||
        this.doc.documentElement.clientHeight ||
        this.doc.body.clientHeight ||
        this.doc.body.offsetHeight;
    }

    /**
     * Get document width
     *
     * @access public
     */
    width() {
        return window.innerWidth ||
        this.doc.documentElement.clientWidth ||
        this.doc.body.clientWidth ||
        this.doc.body.offsetWidth;
    }

    /**
     * Resize screen
     *
     * @access public
     */
    resizeScreen() {
        var margin = 115;
        var height = $(document).height();
        $("main").css("height", parseInt(
            height - ($("body").height() - ($("main").height() - margin)) / 2
        ));
        $(".centralize").css("margin-top", parseInt(
            (height - ($(".centralize").height() + margin)) / 2
        ));
    }

    /**
     * Window resize event
     *
     * @param {Callback} callback
     * @access public
     */
    windowResizeEvent(callback) {
        var resizeTimer = false;
        $(window).on("resize", function (e) {
            if (!resizeTimer) {
                $(window).trigger("resizestart");
            }
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function () {
                resizeTimer = false;
                $(window).trigger("resizeend");
            }, 1);
        }).on("resizestart", function () {

        }).on("resizeend", function () {
            callback();
        });
    }

    /**
     * Error information
     *
     * error(function (info) {
     *     // info.message | info.file | info.line | info.col | info.error
     *     console.log(info);
     * });
     *
     * @param {Callback} callback
     * @access public
     */
    error(callback) {
        window.onerror = function (message, file, line, col, error) {
            let info     = {};
            info.message = message;
            info.file    = file;
            info.line    = line
            info.col     = col;
            info.error   = error;
            return callback(info);
        };
    }
}
