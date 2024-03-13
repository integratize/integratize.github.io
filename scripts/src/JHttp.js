/*
| ------------------------------------------------------------------------------
| JHttp
| ------------------------------------------------------------------------------
*/
class JHttp {

    /**
     * Class constructor
     *
     * function my_function(error, response) {
     *     if (!error) {
     *         console.log(response.data);
     *     } else {
     *         console.log(response.data);
     *     }
     * }
     *
     * <a class="ajax" href="/route" data-ajax-return="my_function">Link</a>
     * <form class="ajax" action="/route" data-ajax-return="my_function"></form>
     *
     * @access public
     */
    constructor() {
        $(document).on("click", "a.ajax", function (e) {
            var href = $(this).attr("data-ajax-href") || $(this).attr("href");
            if ($(this).attr("data-ajax-return")) {
                $_["http"].ajax(href, (error, response) => {
                    response.self = $(this);
                    window.history.pushState(null, "", $(this).attr("href"));
                    window[$(this).attr("data-ajax-return")](error, response);
                });
                e.preventDefault();
            }
        });
        $(document).on("submit", "form.ajax", function (e) {
            if ($(this).attr("data-ajax-return")) {
                const button = $('button[type="submit"]', this);
                const text   = button.html();
                button.html("<i class=\"fa-solid fa-cog fa-spin\"></i>");
                button.addClass("disabled");
                $_["http"].request(e.target.action, $(this).serialize(),
                (error, response) => {
                    button.html(text);
                    button.removeClass("disabled");
                    response.reset = () => $(this).trigger("reset");
                    window[$(this).attr("data-ajax-return")](error, response);
                });
                e.preventDefault();
            }
        });
    }

    /**
     * HTTP request - GET | POST
     *
     * ajax("/my/route/here", (error, response) => {
     *     if (!error) {
     *         return console.log(response.data);
     *     }
     *     console.log(response);
     * });
     *
     * @param {String} url
     * @param {Function} callback
     * @access public
     */
    ajax(url, callback) {
        $_["http"].request(url, (error, response) => {
            callback(error, response);
        });
    }

    /**
     * HTTP request via GET
     *
     * const url = "/my/route/here" or "http://domain.ext/query/..."
     * get(url, (error, response) => {
     *     if (!error) {
     *         return console.log(response);
     *     }
     *     console.log(error);
     * });
     *
     * get(url)
     * .then(response => console.log(response))
     * .catch(error => console.log(error));
     *
     * @param {String} url
     * @param {Function} callback
     * @access public
     */
    get(url, callback = null) {
        var options = {};
        try {
            const $url = new URL(url);
            options.baseURL = $url.protocol + "//" + $url.host
            url = url.split(options.baseURL)[1];
        } catch(e) {}
        return axios.create(options)
                    .get(url)
                    .then(response => callback ?
                                      callback(false, response.data) :
                                      response.data)
                    .catch(error => callback ?
                                    callback(true, error.response) :
                                    error.response);
    }

    /**
     * HTTP request - GET | POST
     *
     * => GET
     *
     * request("/app-route", (error, response) => {
     *     if (!error) {
     *         console.log(response.data);
     *     } else {
     *         console.log(response);
     *     }
     * });
     *
     * => POST
     *
     * request("/app-route", "Form data", (error, response) => {
     *     if (!error) {
     *         console.log(response.data);
     *     } else {
     *         console.log(response);
     *     }
     * });
     *
     * @param {String} url
     * @param {String} data
     * @param {Function} callback
     * @access public
     */
    request(url, data = null, callback = null) {
        let type     = "get",
            error    = false,
            response = {};
        if (type_of(data) === "function") {
            callback = data;
            data     = null;
        } else if (type_of(data) === "string") {
            type = "post";
        }
        axios.defaults.headers.common["Ajax"] = true;
        axios[type](url, data).then(res => {
            response = res;
        }).catch(error => {
            response = error.response;
            error    = true;
        }).finally(() => {
            callback(error, response);
        });
    }
}
