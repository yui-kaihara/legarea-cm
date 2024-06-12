import React from 'react';
import ReactDOM from 'react-dom/client';
import Popup from './Popup';

const PopupUpdate = () => {
    const id = "popup-update";

    return (
        <Popup id={id} />
    );
};

export default PopupUpdate;

if (document.getElementById('popup-update')) {
    const Index = ReactDOM.createRoot(document.getElementById("popup-update"));

    Index.render(
        <React.StrictMode>
            <PopupUpdate/>
        </React.StrictMode>
    )
}