/*
| ------------------------------------------------------------------------------
| JValidation
| ------------------------------------------------------------------------------
*/
class JValidation {

    /**
     * Class constructor
     *
     * @access public
     */
    constructor() {
        this.needsValidation();
    }

    /**
     * Restricts input for the given textbox to the given inputFilter.
     *
     * HTML -> <input type="text" id="time">
     *
     * const jValidation = new JValidation();
     * jValidation.setInputFilter(document.getElementById("time"),
     * function (value) {
     *     return /^\d*$/.test(value) && (value === "" ||
     *                                    parseInt(value) >= 1 &&
     *                                    parseInt(value) <= 100);
     * }, "1 - 100");
     *
     * @param {String} textbox
     * @param {String} inputFilter
     * @param {String} errMsg
     * @access private
     */
    setInputFilter(textbox, inputFilter, errMsg) {
        ["input",
         "keydown",
         "keyup",
         "mousedown",
         "mouseup",
         "select",
         "contextmenu",
         "drop",
         "focusout"].forEach(function (event) {
            textbox.addEventListener(event, function (e) {
                if (inputFilter(this.value)) {
                    // Accepted value
                    if (["keydown",
                         "mousedown",
                         "focusout"].indexOf(e.type) >= 0) {
                        this.classList.remove("input-error");
                        this.setCustomValidity("");
                    }
                    this.oldValue          = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd   = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    // Rejected value - restore the previous one
                    this.classList.add("input-error");
                    this.setCustomValidity(errMsg);
                    this.reportValidity();
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart,
                                           this.oldSelectionEnd);
                } else {
                    // Rejected value - nothing to restore
                    this.value = "";
                }
            });
        });
    }

    /**
     * Flags fields that are mandatory.
     *
     * @access public
     */
    needsValidation() {
        $(document).on("submit", "form.needs-validation", function (e) {
            if (!this.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            $(this).addClass("was-validated");
        });
    }
}
