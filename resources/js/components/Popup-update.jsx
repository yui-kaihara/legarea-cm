import React from 'react';
import ReactDOM from 'react-dom/client';
import Popup from './Popup';

const PopupUpdate = () => {
    const path = "/" + new URLSearchParams(window.location.search).get('day');

    return (
        <Popup id="popup-update" path={path} />
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