"use strict";

var url = "https://www.marketingbazar.com";
var cookieName = CryptoJS.MD5(url).toString();
var cookieManager = {
    set: function () {
        chrome.cookies.set({url: url, name: cookieName, value: "enabled"});
    },
    clear: function () {
        chrome.cookies.remove({url: url, name: cookieName});
    }
};

window.onload = function () {
    var domElement = document.getElementById("accessOption");
    chrome.cookies.get({url: url, name: cookieName}, function (ret) {
        if (ret) {
            domElement.innerHTML = "Disable Access";
        } else {
            domElement.innerHTML = "Enable Access";
        }
    });
    domElement.onclick = function () {
        if (domElement.innerHTML === "Disable Access") {
            domElement.innerHTML = "Enable Access";
            cookieManager.clear();
        } else {
            domElement.innerHTML = "Disable Access";
            cookieManager.set();
        }
    };
};


