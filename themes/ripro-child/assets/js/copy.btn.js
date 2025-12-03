/**
 * Title 复制按钮
 * Description   www.zyfx8.cn 资源分享吧
 * Author   老雷
 */
// 复制按钮
if ($('#refurl,.setclipboard').length > 0) {
    var clipboard = new ClipboardJS('#refurl,.setclipboard');
    clipboard.on('success', function (e) {
        const Toast = Swal.mixin({
            toast: true,
            showConfirmButton: false,
            timer: 3000
        });
        Toast.fire({
            type: 'success',
            title: '复制成功：' + e.text
        })
    });
    clipboard.on('error', function (e) {
        const Toast = Swal.mixin({
            toast: true,
            showConfirmButton: false,
        });
        Toast.fire({
            type: 'error',
            title: '复制失败：' + e.text
        })
    });
}

//复制链接
function jsCopyb() {
    var e = document.getElementById("copywp");//对象是code
    e.select(); //选择对象
    tag = document.execCommand("Copy"); //执行浏览器复制命令
    if (tag) {
        alert('链接已复制！请带上链接咨询。');
    }
};