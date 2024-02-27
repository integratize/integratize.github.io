class JScript {

    /**
     * Class constructor
     *
     * @access public
     */
    constructor() {
        window.$_      = [];
        window.global  = window;
        global.type_of = obj => Object.prototype
                                      .toString
                                      .call(obj)
                                      .slice(8, -1)
                                      .toLowerCase();
        String.prototype.capitalize = function () {
            return this.replace(/\b[a-z]/g, match => match.toUpperCase())
        };
        if (!window["module"]) {
            global.module  = {};
            module.exports = null;
        }
        $_["document"]   = new JDocument();
        $_["http"]       = new JHttp();
        $_["file"]       = new JFile();
        $_["language"]   = new JLanguage();
        $_["element"]    = new JElement();
        $_["time"]       = new JTime();
        $_["component"]  = new JComponent();
        $_["validation"] = new JValidation();
    }

    /**
     * Initialization
     *
     * @access public
     */
    init() {
        $_["component"].navbar();
        $_["component"].navbar().effect("dark-to-light");
        $("[onload]").trigger("onload");
    }
}
