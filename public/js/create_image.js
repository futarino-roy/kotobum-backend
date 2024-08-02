document.querySelectorAll("button[data-role='saveimage']").forEach(v => v.addEventListener("click", async(e) => {
    dispLoading("処理中");
    let imgbases = document.getElementsByClassName("sheet");
    imgbases = Array.from(imgbases);

    // 非同期関数内で処理を実行
    async function processImages() {
        const scale = 3;
        for (const imgbase of imgbases) {
            // 画像処理
            let dl = document.createElement("a");
            dl.href = await domtoimage.toPng(imgbase, {
                height: imgbase.offsetHeight * scale,
                style: {
                    transform: `scale(${scale}) translate(${imgbase.offsetWidth * (scale - 1) / 2 / scale}px, ${imgbase.offsetHeight * (scale - 1) / 2 / scale}px)`
                },
                width: imgbase.offsetWidth * scale
            });
            dl.download=`${imgbase.id}.png`;
            dl.click();
        }
    }

    // 非同期関数を呼び出し、処理完了を待つ
    await processImages();

    removeLoading();
}));

function dispLoading(msg){
    // 引数なしの場合、メッセージは非表示。
    if(msg === undefined ) msg = "";

    // 画面表示メッセージを埋め込み
    var innerMsg = "<div id='innerMsg'>" + msg + "</div>";

    // ローディング画像が非表示かどうかチェックし、非表示の場合のみ出力。
    if($("#nowLoading").length == 0){
        $("body").append("<div id='nowLoading'>" + innerMsg + "</div>");
    }
}

/* ------------------------------
表示ストップ用の関数
------------------------------ */
function removeLoading(){
    $("#nowLoading").remove();
}
