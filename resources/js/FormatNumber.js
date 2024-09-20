export function formatNumber(input) {
    // 入力からカンマとマイナス記号を削除
    var value = input.value.replace(/,/g, '').replace(/-/g, '');

    // 数値かどうかを確認
    if (!isNaN(value) && value !== '') {

        // 数値であればカンマ区切りでフォーマット
        var formattedValue = Number(value).toLocaleString();

        // フォーマット済みの数値を表示
        input.value = formattedValue;
    } else {

        // 数値でない場合、入力をクリア
        input.value = '';
    }
};
