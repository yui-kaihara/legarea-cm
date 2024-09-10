//金額の入力値を3桁のカンマ区切りで表示
export function formatNumber(input) {
    // 入力からすべての非数字文字を削除
    var value = input.value.replace(/,/g, '');
    
    // カンマ区切りでフォーマット
    var formattedValue = Number(value).toLocaleString();
    
    // フォーマット済みの数値を表示
    input.value = formattedValue;
};