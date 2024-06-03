import React from 'react';
import ReactDOM from 'react-dom/client';

function Example() {
    return (
        <div className="container">
            <div className="row justify-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">Example Component</div>

                        <div className="card-body">I'm an example component!</div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Example;

if (document.getElementById('example')) {
    const Index = ReactDOM.createRoot(document.getElementById("example"));

    Index.render(
        <React.StrictMode>
            <Example/>
        </React.StrictMode>
    )
}
//スタイルはtailwindが使える（デフォルトはbootstrap）
//Exampleコンポーネントを表示させたい場合は、ビュー側に<div id="example"></div>を記述
