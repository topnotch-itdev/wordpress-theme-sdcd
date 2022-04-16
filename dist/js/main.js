function xhrSuccess() {
    console.log(this.statusText);
}

function xhrError() {
    console.error(this.statusText);
}

function xhrPostData(url, callback) {
    var xhr = new XMLHttpRequest();

    xhr.callback = callback;
    xhr.onload = xhrSuccess;
    xhr.onerror = xhrError;

    xhr.open("GET", url, true);
    xhr.send(null);
}

function HideTab(name) {
    var element = document.querySelector('[data-target="' + name + '"]');

    if (element != null)
        element.style.display = "none";
}

function OrderTabs(count) {
    var active = false;

    for (index = 1; index <= 6; index++) {
        var element = document.querySelector('[data-target="tab-' + index + '"]');
        var childElement = document.querySelector('[data-id="' + index + '"]');

        if (element != null) {
            if (element.style.display != "none") {
                var css = element.classList[2];

                if (active == false) {
                    element.classList.remove("is-active");
                    element.classList.add("is-active");

                    childElement.classList.remove("is-active");
                    childElement.classList.add("is-active");

                    active = true;
                }

                element.classList.remove(css);
                element.classList.add('u-' + (12 / (count == 0 ? 1 : count)) + '/12@tablet');
            }
            else {
                element.classList.remove("is-active");
                childElement.classList.remove("is-active");
            }
        }
    }
}

function GetQueryParameters(querystring)
{
    var hashes = querystring.slice(querystring.indexOf('?') + 1).split('&');
    var vars = [], hash;

    for (var index = 0; index < hashes.length; index++)
    {
        hash = hashes[index].split('=');

        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }

    return vars;
}