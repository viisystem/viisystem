$.i18n.init({
    lng: $('html').attr('lang'),
    fallbackLng: false,
    useLocalStorage: true,
    resGetPath: '../messages/__lng__/__ns__.json'
});
