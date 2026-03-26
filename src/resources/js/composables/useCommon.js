export function useCommon() {

    const getNowDate = function( time = false ) {
        const now = new Date();

        let date_full_text = '';
        let year  = now.getFullYear();
        let month = now.getMonth() + 1;
        let day   = now.getDate();

        month = month >= 10 ? month : '0' + month;
        day = day >= 10 ? day : '0' + day;

        date_full_text = year + '-' + month + '-' + day;

        if( time ) {
            let hour   = now.getHours();
            let minute = now.getMinutes();
            let second = now.getSeconds();

            hour   = hour >= 10 ? hour : '0' + hour;
            minute = minute >= 10 ? minute : '0' + minute;
            second = second >= 10 ? second : '0' + second;

            date_full_text += ' ' + hour + ':' + minute + ':' + second;
        }

        return date_full_text;
    }

    return {
        getNowDate
    }
}