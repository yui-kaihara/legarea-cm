import React, {useEffect, useState} from 'react';
import ReactDOM from 'react-dom/client';

const PopupDelete = () => {
    const [show, setShow] = useState(false);

    //ポップアップ開閉
    const togglePopup = () => {
        setShow(!show);
    };
    
    //パラメータ追加
    const addParam = () => {
        const checkedData = document.querySelectorAll("input[name=date]:checked");
        let checkedValue = 0;
    
        if (checkedData.length > 0) {
            const days = [];
            const datas = [];
            checkedData.forEach((key, index) => {
                days.push(checkedData[index].value.split('-')[0]);
                datas.push(checkedData[index].value.split('-')[1]);
            });

            const yearMonth = document.getElementById('popup-delete').getAttribute('data-year-month').split('-');

            //URLにパラメータを追加
            const params = new URLSearchParams({
                year: yearMonth[0],
                month: yearMonth[1],
                day: days,
                data: datas,
                popup: 'delete'
            }).toString();
            window.location.search = `?${params}`;
        }
    }
    
    //アラートメッセージ
    const alertMessage = () => {
        const checkedData = document.querySelectorAll("input[name=date]:checked");
            
        if (checkedData.length == 0) {
            alert('日付をチェックしてください');
        }
    }
    
    //関数実行
    const handleClick = () => {
        
        alertMessage();
        addParam();
    };
    
    //addParamの画面リロードが終わったらtogglePopupを実行
    useEffect(() => {
        const params = new URLSearchParams(window.location.search);
        if (params.get('popup') === 'delete') {
            togglePopup();
        }
    }, []);
    
    const allCheck = () => {
        const checkeEements = document.querySelectorAll('.is-check');
        const allCheckElement = document.querySelectorAll('.is-allCheck')[0];

        if (allCheckElement.checked) {
            
            //取得した各要素にcheckedとdisabled、グレーアウトを設定
            checkeEements.forEach(element => {
                element.checked = true;
                element.disabled = true;
                element.classList.add('checked:bg-gray-200');
            });  
        } else {

            //設定したものを戻す
            checkeEements.forEach(element => {
                element.checked = false;
                element.disabled = false;
                element.classList.remove('checked:bg-gray-200');
            });
        }
        
    }

    //csrfトークンを取得
    const csrfToken = document.querySelector("meta[name='csrf-token']");
    
    //パラメータdayを取得
    let days = new URLSearchParams(window.location.search).get('day');

    //フォームの送信先
    let formUrl = '';
    if (days) {
        days = days.split(',');
        formUrl = window.location.origin + '/cm/' + days[0];
    }
    
    //キャンセルの遷移先
    const cancelUrl = window.location.origin + '/cm';
    
    //チェックされた日付を取得
    const yearMonth = document.getElementById('popup-delete').getAttribute('data-year-month');
    
    //飲食店データ取得
    const shopIds = document.getElementById('popup-delete').getAttribute('data-shop-id');

    //SESデータ取得
    const sesIds = document.getElementById('popup-delete').getAttribute('data-ses-id');
    const sesIrregularFlags = document.getElementById('popup-delete').getAttribute('data-ses-irregular-flag');
    
    //その他データ取得
    const otherIds = document.getElementById('popup-delete').getAttribute('data-other-id');
    const otherIrregularFlags = document.getElementById('popup-delete').getAttribute('data-other-irregular-flag');

    return (
        <div>
            <button onClick={handleClick} className="flex justify-center items-center gap-1 cursor-pointer py-2 px-4 text-sm font-semibold rounded border border-gray-400 bg-white text-gray-600 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none no-underline">
                <svg class="h-5 w-5"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="4" y1="7" x2="20" y2="7" />  <line x1="10" y1="11" x2="10" y2="17" />  <line x1="14" y1="11" x2="14" y2="17" />  <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />  <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                削除
            </button>
            {show && (
                <div className="fixed top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2 w-1/4 mx-auto p-7 bg-white border rounded-lg shadow-md text-xs z-10">
                    <div class="mb-10">
                        {[...new Set(days)].map((day, index) => (
                            <p className="mb-2 font-semibold">{yearMonth}-{day}</p>
    
                        ))}
                    </div>
                    <a href={cancelUrl} class="absolute top-2.5 right-2.5">
                        <svg class="h-5 w-5"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="18" y1="6" x2="6" y2="18" />  <line x1="6" y1="6" x2="18" y2="18" /></svg>
                    </a>
                    <form action={formUrl} method="POST">
                        <input type="hidden" name="_token" value={csrfToken.content} />
                        <input type="hidden" name="_method" value="DELETE" />
                        <input type="hidden" name="date" value={days} />
                        <input type="hidden" name="shop_id" value={shopIds} />
                        <input type="hidden" name="ses_id" value={sesIds} />
                        <input type="hidden" name="ses_irregular" value={sesIrregularFlags} />
                        <input type="hidden" name="other_id" value={otherIds} />
                        <input type="hidden" name="other_irregular" value={otherIrregularFlags} />
                        <label class="flex gap-2 w-1/4 mb-10 cursor-pointer"><input type="checkbox" name="delete[]" value="1" onChange={allCheck} class="cursor-pointer is-allCheck" />すべて</label>
                        <label class="flex gap-2 w-1/4 mb-10 cursor-pointer"><input type="checkbox" name="delete[]" value="2" class="cursor-pointer checked:hover:bg-gray-200 is-check" />飲食</label>
                        <label class="flex gap-2 w-1/4 mb-10 cursor-pointer"><input type="checkbox" name="delete[]" value="3" class="cursor-pointer checked:hover:bg-gray-200 is-check" />SES</label>
                        <label class="flex gap-2 w-1/4 cursor-pointer"><input type="checkbox" name="delete[]" value="4" class="cursor-pointer checked:hover:bg-gray-200 is-check" />その他</label>

                        <div className="flex justify-center gap-1 mt-12">
                            <a href={cancelUrl} class="w-32 cursor-pointer py-3 px-4 font-semibold rounded-lg border border-transparent bg-gray-100 text-gray-800 text-center">キャンセル</a>
                            <input type="submit" value="削除" className="w-32 cursor-pointer py-3 px-4 font-semibold rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 text-center" />
                        </div>
                    </form>
                </div>
            )}
        </div>
    );
};

export default PopupDelete;

if (document.getElementById('popup-delete')) {
    const Index = ReactDOM.createRoot(document.getElementById("popup-delete"));

    Index.render(
        <React.StrictMode>
            <PopupDelete/>
        </React.StrictMode>
    )
}