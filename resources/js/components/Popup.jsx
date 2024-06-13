import React, { useState } from 'react';

const Popup = ({ id, path }) => {
    const [show, setShow] = useState(false);

    const togglePopup = () => {
        setShow(!show);
    };

    //入力値
    const [stateSales1, setStateSales1] = useState("");
    const [stateSales2, setStateSales2] = useState("");
    const [stateCompanyName, setStateCompanyName] = useState("");
    const [statePersonnelName, setStatePersonnelName] = useState("");
    const [stateSesType, setStateSesType] = useState("");
    const [stateSesAmount, setStateSesAmount] = useState("");
    const [stateSesBank, setStateSesBank] = useState("");
    const [stateSummaryId, setStateSummaryId] = useState("");
    const [stateOtherAmount, setStateOtherAmount] = useState("");
    const [stateOtherType, setStateOtherType] = useState("");
    const [stateOtherBank, setStateOtherBank] = useState("");

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

    return (
        <div>
            <button onClick={togglePopup} className="flex justify-center items-center gap-1 cursor-pointer py-2 px-4 text-sm font-semibold rounded border border-gray-400 bg-white text-gray-600 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none no-underline">{submitText}</button>
            {show && (
                <div className="absolute top-1/4 left-1/4 w-1/2 mx-auto p-7 bg-white rounded-lg shadow-md text-xs is-show">
                    <div class="flex justify-between items-start">
                        <p className="mb-5 font-semibold">2024-06-02</p>
                        <button onClick={togglePopup}>
                        <svg class="h-5 w-5"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="18" y1="6" x2="6" y2="18" />  <line x1="6" y1="6" x2="18" y2="18" /></svg>
                    </button>
                    </div>
                    <form action={url} method="POST">
                        <input type="hidden" name="_token" value={csrfToken.content} />
                        <input type="hidden" name="date" value="2024-06-02" />
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
                                            <option value={index+1}>{type}</option>
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
                                            <option value={index}>{summaryItem}</option>
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
                                            <option value={index+1}>{type}</option>
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
