import React, { useState } from 'react';
import ReactDOM from 'react-dom/client';

function Popup() {
    const [show, setShow] = useState(false);

    const togglePopup = () => {
        setShow(!show);
    };
    
    //入金種別の配列を用意
    const types = document.getElementById('popup').getAttribute('data-type').split(",");
    
    //摘要項目の配列を用意
    const summaryItemNames = document.getElementById('popup').getAttribute('data-summary-item-name').split(",");
    const summaryItemIds = document.getElementById('popup').getAttribute('data-summary-item-id').split(",");
    const summaryItems = [];
    summaryItemIds.forEach((key, index) => {
        summaryItems[key] = summaryItemNames[index];
    });
    
    //送信ボタンの文言を取得
    const submitText = document.getElementById('popup').getAttribute('data-submit-text');

    return (
        <div>
            <button onClick={togglePopup} className="flex justify-center items-center gap-1 cursor-pointer py-2 px-4 text-sm font-semibold rounded border border-gray-400 bg-white text-gray-600 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none no-underline">編集</button>
            {show && (
                <div className="popup absolute top-1/4 left-1/4 w-1/2 mx-auto p-7 bg-white rounded-lg shadow-md text-xs is-show">
                    <div class="flex justify-between items-start">
                        <p className="mb-5 font-semibold">2024-06-02</p>
                        <button onClick={togglePopup}>
                        <svg class="h-5 w-5"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="18" y1="6" x2="6" y2="18" />  <line x1="6" y1="6" x2="18" y2="18" /></svg>
                    </button>
                    </div>
                    <form action="" method="POST">
                        <div className="mb-10">
                            <span className="font-semibold">飲食</span>
                            <div className="flex gap-3 mt-2">
                                <label htmlFor="">
                                    ○○店
                                    <input type="number" name="" value="" className="block w-36 mt-1 px-4 border-gray-200 rounded-lg text-xs" id="" />
                                </label>
                                <label htmlFor="">
                                    ○○店
                                    <input type="number" name="" value="" className="block w-36 mt-1 px-4 border-gray-200 rounded-lg text-xs" id="" />
                                </label>
                            </div>
                        </div>
                        <div className="mb-10">
                            <span className="font-semibold">SES</span>
                            <div className="flex gap-3 mt-2">
                                <label htmlFor="">
                                    会社名
                                    <input type="text" name="" value="" className="block w-36 mt-1 px-4 border-gray-200 rounded-lg text-xs" id="" />
                                </label>
                                <label htmlFor="">
                                    要員名
                                    <input type="text" name="" value="" className="block w-36 mt-1 px-4 border-gray-200 rounded-lg text-xs" id="" />
                                </label>
                                <label htmlFor="">
                                    入金種別
                                    <select name="type" className="block w-20 mt-1 px-4 border-gray-200 rounded-lg text-xs cursor-pointer" id="type">
                                        <option value=""></option>
                                        {types.map((type, index) => (
                                            <option value={index+1}>{type}</option>
                                        ))}
                                    </select>
                                </label>
                                <label htmlFor="">
                                    金額
                                    <input type="number" name="" value="" className="block w-36 mt-1 px-4 border-gray-200 rounded-lg text-xs" id="" />
                                </label>
                                <label htmlFor="">
                                    入出金銀行
                                    <input type="text" name="" value="" className="block w-36 mt-1 px-4 border-gray-200 rounded-lg text-xs" id="" />
                                </label>
                            </div>
                        </div>
                        <div>
                            <span className="font-semibold">その他</span>
                            <div className="flex gap-3 mt-2">
                                <label htmlFor="">
                                    摘要
                                    <select name="summary_id" className="block w-36 mt-1 px-4 border-gray-200 rounded-lg text-xs cursor-pointer" id="summary_id">
                                        <option value=""></option>
                                        {summaryItems.map((summaryItem, index) => (
                                            <option value={index}>{summaryItem}</option>
                                        ))}
                                    </select>
                                </label>
                                <label htmlFor="">
                                    金額
                                    <input type="number" name="" value="" className="block w-36 mt-1 px-4 border-gray-200 rounded-lg text-xs" id="" />
                                </label>
                                <label htmlFor="">
                                    入金種別
                                    <select name="type" className="block w-20 mt-1 px-4 border-gray-200 rounded-lg text-xs cursor-pointer" id="type">
                                        <option value=""></option>
                                        {types.map((type, index) => (
                                            <option value={index+1}>{type}</option>
                                        ))}
                                    </select>
                                </label>
                                <label htmlFor="">
                                    入出金銀行
                                    <input type="text" name="" value="" className="block w-36 mt-1 px-4 border-gray-200 rounded-lg text-xs" id="" />
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

if (document.getElementById('popup')) {
    const Index = ReactDOM.createRoot(document.getElementById("popup"));

    Index.render(
        <React.StrictMode>
            <Popup/>
        </React.StrictMode>
    )
}
