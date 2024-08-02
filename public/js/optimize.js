// ノードを作成するメソッド
function create_node(html_id){
    const sheetList = document.getElementById('sheet_list');
    const sheet = document.createElement('div');
    sheet.setAttribute('id', `sheet_${html_id}`);
    sheet.classList.add('sheet');
    sheetList.appendChild(sheet);
    const hr = document.createElement('hr');
    sheetList.appendChild(hr);
    const torisetsu =
    `<div class="torisetsu">
        <div class="up">
            <div class="title">
                <img src="/images/title.png">
                <p class="title__sub">※パートナー専用</p>
            </div>
            <div class="main">
                <div class="top">
                    <div class="sub-title">
                        FUTARINO TORISETSU
                    </div>
                    <div class="date">
                    </div>
                </div>
                <div class="name">
                </div>
                <div class="content">
                    <div class="good_at">
                        <h2><img src="/icons/checkbox.svg" width="20px"> 得意なこと</h2>
                        <p>
                            <span class="good_at_content"></span>
                        </p>
                    </div>
                    <div class="weak_point">
                        <h2><img src="/icons/checkbox.svg" width="20px"> 苦手なこと</h2>
                        <p>
                            <span class="weak_point_content"></span>
                        </p>
                    </div>
                    <div class="good">
                        <h2><img src="/icons/checkbox.svg" width="20px"> 機嫌がよくなる、推奨行為👍</h2>
                        <p>
                            <span class="good_content"></span>
                        </p>
                    </div>
                    <div class="bad">
                        <h2><img src="/icons/checkbox.svg" width="20px"> 機嫌が悪くなる、地雷💣</h2>
                        <p>
                            <span class="bad_content"></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="down">
            <div class="icon">
                <img src="/images/warning.png">
            </div>
            <div class="more">
                <h2><img src="/icons/checkbox.svg" width="20px"> 状況別対処法</h2>
                <div class="more_list">
                </div>
            </div>
        </div>
    </div>
    <div class="note">
        ※返品交換できかねますのでご了承ください
    </div>`

    sheet.innerHTML = torisetsu;
}

function insert_data(answer, html_id){
    // 回答のobjectのkeyだけの配列
    const key_list = Object.keys(answer);
    const sheet = document.getElementById(`sheet_${html_id}`);
    key_list.forEach(function (key) {
        let more_list = sheet.querySelectorAll(".more_list")[0];
        let more_list_title = document.createElement('h3');
        let more_list_content = document.createElement('p');

        if (key.indexOf('トリセツに記載するお名前') !== -1){
            sheet.querySelectorAll(".name")[0].innerHTML = `<p>${answer[key].toUpperCase()}</p><img src="/images/pencil.png">`;
            return
        }
        else if (key.indexOf('あなたの得意なこと') !== -1){
            sheet.querySelectorAll(".good_at_content")[0].innerHTML = answer[key].replace(/\n/g, '<br>');
            return
        }
        else if (key.indexOf('あなたの苦手なこと') !== -1){
            sheet.querySelectorAll(".weak_point_content")[0].innerHTML = answer[key].replace(/\n/g, '<br>');
            return
        }
        else if (key.indexOf('機嫌が良くなる、推奨行為') !== -1){
            sheet.querySelectorAll(".good_content")[0].innerHTML = answer[key].replace(/\n/g, '<br>');
            return
        }
        else if (key.indexOf('機嫌が悪くなる、地雷') !== -1){
            sheet.querySelectorAll(".bad_content")[0].innerHTML = answer[key].replace(/\n/g, '<br>');
            return
        }
        else if (key.indexOf('私が落ち込んでいるとき') !== -1){
            more_list_title.innerHTML = '落ち込んでいる時';
            more_list_content.innerHTML = `${answer[key].replace(/\n/g, '<br>')}`;
            more_list.appendChild(more_list_title);
            more_list.appendChild(more_list_content);
            return
        }
        else if (key.indexOf('私が体調不良のとき') !== -1){
            more_list_title.innerHTML = '体調不良の時';
            more_list_content.innerHTML = `${answer[key].replace(/\n/g, '<br>')}`;
            more_list.appendChild(more_list_title);
            more_list.appendChild(more_list_content);
            return
        }
        else if (key.indexOf('私が仲直りしたいとき') !== -1){
            more_list_title.innerHTML = '仲直りしたいとき';
            more_list_content.innerHTML = `${answer[key].replace(/\n/g, '<br>')}`;
            more_list.appendChild(more_list_title);
            more_list.appendChild(more_list_content);
            return
        }
        else if (key.indexOf('私が不機嫌なとき') !== -1){
            more_list_title.innerHTML = '不機嫌な時';
            more_list_content.innerHTML = `${answer[key].replace(/\n/g, '<br>')}`;
            more_list.appendChild(more_list_title);
            more_list.appendChild(more_list_content);
            return
        }
        else if (key.indexOf('タイムスタンプ') !== -1){
            const date = answer[key];
            const dateText = `${date.getFullYear()}年${date.getMonth() + 1}月${date.getDate()}日`;
            const date_area = sheet.querySelectorAll(".date")[0];
            date_area.textContent = dateText;
            return
        }
        else if (key.indexOf('使用する画像') !== -1){
            let content = sheet.querySelectorAll(".content")[0];
            if (answer[key] === "A"){
                content.innerHTML += '<img src="/images/male.png" class="human_icon">';
            } else if (answer[key] === "B"){
                content.innerHTML += '<img src="/images/female.png" class="human_icon">';
            }
            return
        }
    });

    const more_list = sheet.querySelectorAll(".more_list")[0];
    if (more_list.childElementCount === 0){
        const note = document.createElement('p');
        note.innerHTML = '個別状況につきましては、直接お問い合わせください';
        more_list.appendChild(note);
    }
}

let X = XLSX;

// ファイル選択時のメイン処理
function handleFile(e) {

    let files = e.target.files;
    let f = files[0];

    let reader = new FileReader();
    reader.onload = function (e) {
        let data = e.target.result;
        let wb;
        let arr = fixdata(data);
        wb = X.read(btoa(arr), {
            type: 'base64',
            cellDates: true,
        });

        let output = "";
        // objectの配列（1行目がkeyになってる）
        output = to_json(wb);
        // ペア番号の重複管理用の配列
        let pair_nums = [];
        output.forEach((element) => {
            let key_list = Object.keys(element);
            let pair_num;
            let html_id;
            for (let i=0; i < key_list.length; i++){
                if (key_list[i].indexOf('ペア番号') !== -1){
                    pair_num = element[key_list[i]];
                    html_id = pair_num;
                    pair_nums.push(pair_num);
                    // pair_numsにすでにそのペア番号があればその分だけペア番号の後ろに"_pair"をつける(後でこれをhtmlのidとするため)
                    let count = pair_nums.filter(n => n === pair_num).length;
                    if (count >= 2){
                        for (let i=1; i <= count-1; i++){
                            html_id = html_id + "_pair";
                        }
                    };
                    break;
                };
            };
            create_node(html_id);
            insert_data(element, html_id);
        });

        const json = JSON.stringify(output, null, 2);

        $("pre#result").html(json);

    };

    reader.readAsArrayBuffer(f);
}

// ファイルの読み込み
function fixdata(data) {
    let o = "",
        l = 0,
        w = 10240;
    for (; l < data.byteLength / w; ++l) o += String.fromCharCode.apply(null, new Uint8Array(data.slice(l * w,
        l * w + w)));
    o += String.fromCharCode.apply(null, new Uint8Array(data.slice(l * w)));
    return o;
}

// ワークブックのデータをjsonに変換
function to_json(workbook) {
    let result = {};
    const sheetName = workbook.SheetNames[0];
    let roa = X.utils.sheet_to_json(
            workbook.Sheets[sheetName],
            {
                raw: true,
            });
        if (roa.length > 0) {
            result = roa;
        }
    return result;
}

// 画面初期化
$(document).ready(function () {
    // ファイル選択欄 選択イベント
    // http://cccabinet.jpn.org/bootstrap4/javascript/forms/file-browser
    $('.custom-file-input').on('change', function (e) {
        handleFile(e);
        $(this).next('.custom-file-label').html($(this)[0].files[0].name);
    })
});
