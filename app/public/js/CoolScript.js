;(function () {
    'use strict';

    window.addEventListener('load', function () {
        document.getElementById('form2').setAttribute('novalidate', 'novalidate');
        document.getElementById('form2').addEventListener('submit', function (e) {
            e.preventDefault();
            e.stopPropagation();


        })
    })
});