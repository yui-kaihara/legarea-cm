import React, { useEffect, useState } from 'react';

const Popup = ({ id, path }) => {
    const [show, setShow] = useState(false);

    //ポップアップ開閉
    const togglePopup = () => {
        setShow(!show);
    };
    
    //パラメータ追加
    const addParam = () => {
        const checkedData = document.querySelectorAll("input[name=date]:checked");
        let checkedValue = 0;
    
        if (checkedData.length == 1) {
            checkedValue = checkedData[0].value;
            
            //URLにパラメータを追加
            const params = new URLSearchParams({
                day: checkedValue.split('')[0],
                data: checkedValue.split('')[2],
                popup: 'true'
            }).toString();
            window.location.search = `?${params}`;
        }
    }
    
    //アラートメッセージ
    const alertMessage = () => {
        const checkedData = document.querySelectorAll("input[name=date]:checked");

        if (id == 'popup-update') {
            
            if (checkedData.length == 0) {
                alert('日付をチェックしてください');
            } else if (checkedData.length > 1) {
                alert('日付は1つのみチェックしてください');
            }
        }
    }
    
    //関数実行
    const handleClick = () => {
        
        if (id == 'popup-update') {
            alertMessage();
            addParam();
        } else {
            togglePopup();
        }
        
    };
    
    //addParamの画面リロードが終わったらtogglePopupを実行
    if (id == 'popup-update') {
        useEffect(() => {
            const params = new URLSearchParams(window.location.search);
            if (params.get('popup') === 'true') {
                togglePopup();
            }
        }, []);
    }

    //入力値
    let [stateSelectDate, setStateSelectDate] = useState("");
    let [stateSales1, setStateSales1] = useState("");
    let [stateSales2, setStateSales2] = useState("");
    let [stateCompanyName, setStateCompanyName] = useState("");
    let [statePersonnelName, setStatePersonnelName] = useState("");
    let [stateSesType, setStateSesType] = useState("");
    let [stateSesAmount, setStateSesAmount] = useState("");
    let [stateSesBank, setStateSesBank] = useState("");
    let [stateSummaryId, setStateSummaryId] = useState("");
    let [stateOtherAmount, setStateOtherAmount] = useState("");
    let [stateOtherType, setStateOtherType] = useState("");
    let [stateOtherBank, setStateOtherBank] = useState("");

    //入金種別の配列を用意
    const types = document.getElementById(id).getAttribute('data-type').split(",");
    
    //摘要項目の配列を用意
    const summaryItemNames = document.getElementById(id).getAttribute('data-summary-item-name').split(",");
    const summaryItemIds = document.getElementById(id).getAttribute('data-summary-item-id').split(",");
    const summaryItems = [];
    summaryItemIds.forEach((key, index) => {
        summaryItems[key] = summaryItemNames[index];
    });

    //送信ボタンの文言を取得
    const submitText = document.getElementById(id).getAttribute('data-submit-text');
    
    //フォームの送信先
    const url = window.location.origin + '/cm' + path;
    
    //csrfトークンを取得
    const csrfToken = document.querySelector("meta[name='csrf-token']");
    
    //ボタンのアイコンを設定
    let icon = <svg class="h-5 w-5" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <rect x="4" y="4" width="16" height="16" rx="2" />  <line x1="9" y1="12" x2="15" y2="12" />  <line x1="12" y1="9" x2="12" y2="15" /></svg>;
    
    //日付
    let date = '';
    
    //日付選択フォーム
    let dateForm = <div className="mb-10"><span className="font-semibold">日付</span><input type="date" name="select_date" value={stateSelectDate} onChange={(e) => setStateSelectDate(e.target.value)} className="block w-36 mt-1 px-4 border-gray-200 rounded-lg text-xs cursor-pointer" /></div>;

    //チェックされた日付を取得
    const yearMonth = document.getElementById(id).getAttribute('data-year-month');
    const day = new URLSearchParams(window.location.search).get('day');

    if (id == 'popup-update') {
        icon = <svg class="h-5 w-5"  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />  <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />  <line x1="16" y1="5" x2="19" y2="8" /></svg>;
        
        if (day) {
            date = yearMonth + '-' + day.split('')[0];
        }

        dateForm = '';
        
        //SESデータ取得
        const sesData = document.getElementById(id).getAttribute('data-ses-data').split(',');

        if (sesData.length > 0) {
            [stateCompanyName, setStateCompanyName] = useState(sesData[0]);
            [statePersonnelName, setStatePersonnelName] = useState(sesData[1]);
            [stateSesType, setStateSesType] = useState(sesData[2]);
            [stateSesAmount, setStateSesAmount] = useState(sesData[3]);
            [stateSesBank, setStateSesBank] = useState(sesData[4]);
        }
        
        //その他データ取得
        const otherData = document.getElementById(id).getAttribute('data-other-data').split(',');
        
        if (otherData.length > 0) {
            [stateSummaryId, setStateSummaryId] = useState(otherData[0]);
            [stateOtherAmount, setStateOtherAmount] = useState(otherData[1]);
            [stateOtherType, setStateOtherType] = useState(otherData[2]);
            [stateOtherBank, setStateOtherBank] = useState(otherData[3]);
        }
    }

    return (
        <div>
            <button onClick={handleClick} className="flex justify-center items-center gap-1 cursor-pointer py-2 px-4 text-sm font-semibold rounded border border-gray-400 bg-white text-gray-600 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none no-underline">
                {icon}
                {submitText}
            </button>
            {show && (
                <div className="absolute top-1/4 left-1/4 w-1/2 mx-auto p-7 bg-white rounded-lg shadow-md text-xs z-10">
                    <div class="flex justify-between items-start">
                        <p className="mb-5 font-semibold">{date}</p>
                        <button onClick={togglePopup}>
                            <svg class="h-5 w-5"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="18" y1="6" x2="6" y2="18" />  <line x1="6" y1="6" x2="18" y2="18" /></svg>
                        </button>
                    </div>
                    <form action={url} method="POST">
                        <input type="hidden" name="_token" value={csrfToken.content} />
                        <input type="hidden" name="date" value={date} />
                        {dateForm}
                        <div className="mb-10">
                            <span className="font-semibold">飲食</span>
                            <div className="flex gap-3 mt-2">
                                <label>
                                    ○○店
                                    <input type="number" name="sales1" value={stateSales1} onChange={(e) => setStateSales1(e.target.value)} className="block w-36 mt-1 px-4 border-gray-200 rounded-lg text-xs" />
                                </label>
                                <label>
                                    ○○店
                                    <input type="number" name="sales2" value={stateSales2} onChange={(e) => setStateSales2(e.target.value)} className="block w-36 mt-1 px-4 border-gray-200 rounded-lg text-xs" />
                                </label>
                            </div>
                        </div>
                        <div className="mb-10">
                            <span className="font-semibold">SES</span>
                            <div className="flex gap-3 mt-2">
                                <label>
                                    会社名
                                    <input type="text" name="company_name" value={stateCompanyName} onChange={(e) => setStateCompanyName(e.target.value)} className="block w-36 mt-1 px-4 border-gray-200 rounded-lg text-xs" />
                                </label>
                                <label>
                                    要員名
                                    <input type="text" name="personnel_name" value={statePersonnelName} onChange={(e) => setStatePersonnelName(e.target.value)} className="block w-36 mt-1 px-4 border-gray-200 rounded-lg text-xs" />
                                </label>
                                <label>
                                    入金種別
                                    <select name="ses_type" className="block w-20 mt-1 px-4 border-gray-200 rounded-lg text-xs cursor-pointer">
                                        <option value=""></option>
                                        {types.map((type, index) => (
                                            <option value={index+1} selected={stateSesType == index+1 ? 'selected' : ''}>{type}</option>

                                        ))}
                                    </select>
                                </label>
                                <label>
                                    金額
                                    <input type="number" name="ses_amount" value={stateSesAmount} onChange={(e) => setStateSesAmount(e.target.value)} className="block w-36 mt-1 px-4 border-gray-200 rounded-lg text-xs" />
                                </label>
                                <label>
                                    入出金銀行
                                    <input type="text" name="ses_bank" value={stateSesBank} onChange={(e) => setStateSesBank(e.target.value)} className="block w-36 mt-1 px-4 border-gray-200 rounded-lg text-xs" />
                                </label>
                            </div>
                        </div>
                        <div>
                            <span className="font-semibold">その他</span>
                            <div className="flex gap-3 mt-2">
                                <label>
                                    摘要
                                    <select name="summary_id" className="block w-36 mt-1 px-4 border-gray-200 rounded-lg text-xs cursor-pointer">
                                        <option value=""></option>
                                        {summaryItems.map((summaryItem, index) => (
                                            <option value={index} selected={stateSummaryId == index ? 'selected' : ''}>{summaryItem}</option>
                                        ))}
                                    </select>
                                </label>
                                <label>
                                    金額
                                    <input type="number" name="other_amount" value={stateOtherAmount} onChange={(e) => setStateOtherAmount(e.target.value)} className="block w-36 mt-1 px-4 border-gray-200 rounded-lg text-xs" />
                                </label>
                                <label>
                                    入金種別
                                    <select name="other_type" className="block w-20 mt-1 px-4 border-gray-200 rounded-lg text-xs cursor-pointer">
                                        <option value=""></option>
                                        {types.map((type, index) => (
                                            <option value={index+1} selected={stateOtherType == index+1 ? 'selected' : ''}>{type}</option>
                                        ))}
                                    </select>
                                </label>
                                <label>
                                    入出金銀行
                                    <input type="text" name="other_bank" value={stateOtherBank} onChange={(e) => setStateOtherBank(e.target.value)} className="block w-36 mt-1 px-4 border-gray-200 rounded-lg text-xs" />
                                </label>
                            </div>
                        </div>
                        <div className="flex justify-center mt-20">
                            <input type="submit" value={submitText} className="w-32 cursor-pointer py-3 px-4 font-semibold rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none" />
                        </div>
                    </form>
                </div>
            )}
        </div>
    );
}

export default Popup;
