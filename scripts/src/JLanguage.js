/*
| ------------------------------------------------------------------------------
| JLanguage
| ------------------------------------------------------------------------------
*/
class JLanguage {

    /**
     * Class constructor
     *
     * @access public
     */
    constructor() {
        $(document).on("click", ".dropdown-language", e => {
            e.preventDefault();
            this.change(e.target.text.trim());
        });
    }

    /**
     * Return the translation
     *
     * translate("Term...");
     *
     * @param {String} term
     * @access public
     */
    translate(term) {
        var language = JSON.parse(sessionStorage.getItem($_["document"].lang));
        return language ? language[term] : term;
    }

    /**
     * Change language
     *
     * @param {String} code
     * @access private
     */
    change(code) {
        $_["http"].request("/language/" + code, (error, response) => {
            var data = JSON.parse(sessionStorage.getItem(code)) || null;
            if (error) {
                console.log(error);
            }
            if (code !== "en" && data === null) {
                sessionStorage.setItem(code, JSON.stringify(response.data));
            }
            window.location.href = "";
        });
    }
}
