$(document).ready(function () {
    //댓글 수정
    $(".dat_edit_bt").click(function () {
        /* dat_edit_bt클래스 클릭시 동작(댓글 수정) */
        var obj = $(this).closest(".dap_lo").find(".dat_edit");
        obj.dialog({
            modal: true,
            width: 650,
            height: 200,
            title: "댓글 수정",
            close: function (event, ui) {
                obj.dialog('destroy');
            }
        });
    });

    //댓글 삭제
    $(".dat_delete_bt").click(function () {
        /* dat_delete_bt클래스 클릭시 동작(댓글 삭제) */
        var obj = $(this).closest(".dap_lo").find(".dat_delete");
        obj.dialog({
            modal: true,
            width: 400,
            title: "댓글 삭제 확인",
            content: "댓글을 삭제하시겠습니까?",
            close: function (event, ui) {
                obj.dialog('destroy');
            }
        });
    });

    //대댓글 작성
    $(".dat_re_edit_bt").click(function () {
        /* dat_re_edit_bt클래스 클릭시 동작(댓글 수정) */
        var obj = $(this).closest(".dap_lo").find(".dat_re_edit");
        obj.dialog({
            modal: true,
            width: 650,
            height: 200,
            title: "답글 달기.",
            close: function (event, ui) {
                obj.dialog('destroy');
            }
        });
    });

    //대댓글 수정
    $(".re_dat_edit_bt").click(function () {
        /* dat_edit_bt클래스 클릭시 동작(댓글 수정) */
        var obj = $(this).closest(".re_reply").find(".dat_re_modify");
        obj.dialog({
            modal: true,
            width: 650,
            height: 200,
            title: "댓글 수정",
            close: function (event, ui) {
                obj.dialog('destroy');
            }
        });
    });

    //대댓글 삭제
    $(".re_dat_delete_bt").click(function () {
        /* dat_delete_bt클래스 클릭시 동작(댓글 삭제) */
        var obj = $(this).closest(".re_reply").find(".dat_re_delete");
        obj.dialog({
            modal: true,
            width: 400,
            title: "댓글 삭제 확인",
            content: "댓글을 삭제하시겠습니까?",
            close: function (event, ui) {
                obj.dialog('destroy');
            }
        });
    });
});

// jQuery(document).ready(function($) {
//     pevent();
// });
//
// function pevent(){
//     function getCookie(name){
//         var nameOfCookie = name + "=";
//         var x = 0;
//         while (x <= document.cookie.length){
//             var y = (x + nameOfCookie.length);
//             if (document.cookie.substring(x, y) == nameOfCookie){
//                 if ((endOfCookie = document.cookie.indexOf(";", y)) == -1){
//                     endOfCookie = document.cookie.length;
//                 }
//                 return unescape (document.cookie.substring(y, endOfCookie));
//             }
//             x = document.cookie.indexOf (" ", x) + 1;
//             if (x == 0) break;
//         }
//         return "";
//     }
//
//     if (getCookie("popname") != "done"){
//         var popUrl = "http://13.209.88.207/popup.php";
//         var popOption = "width=400%, height=235%, resizable=no, scrollbars=no, status=no;";
//         window.open(popUrl,"",popOption);
//     }
// }