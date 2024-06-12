import React from 'react';
import ReactDOM from 'react-dom/client';
import Popup from './Popup';

const PopupRegister = () => {
    const id = "popup-register";

    return (
        <Popup id={id} />
    );
};

export default PopupRegister;

if (document.getElementById('popup-register')) {
    const Index = ReactDOM.createRoot(document.getElementById("popup-register"));

    Index.render(
        <React.StrictMode>
            <PopupRegister/>
        </React.StrictMode>
    )
}