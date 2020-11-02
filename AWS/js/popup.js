function setCookie(name, value)
{
    var todayDate = new Date();
    todayDate.setHours( 24 );
    document.cookie = name+ "=" + escape( value ) + "; path=/; expires=" +   todayDate.toGMTString() + ";";
}

function closeWin()
{
    if ($("#option").is(":checked") )
    {
        setCookie("name", "value");
        window.close();
    }
}

function getCookie(name) {
    var Found = false
    var start, end
    var i = 0

    while(i <= document.cookie.length) {
        start = i
        end = start + name.length

        if(document.cookie.substring(start, end) == name) {
            Found = true
            break
        }
        i++
    }

    if(Found == true) {
        start = end + 1
        end = document.cookie.indexOf(";", start)
        if(end < start)
            end = document.cookie.length
        return document.cookie.substring(start, end)
    }
    return ""
}