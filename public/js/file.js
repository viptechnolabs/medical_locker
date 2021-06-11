function selectFile(th, imageSelector) {
    const files = !!th.files ? th.files : [];
    if (!files.length || !window.FileReader) return;
    if (/^image/.test(files[0].type)) {
        const reader = new FileReader();
        reader.readAsDataURL(files[0]);
        reader.onloadend = function (e) {
            $(imageSelector).attr('src', e.target.result).show();

            $(th).valid();
        }
    }
}
