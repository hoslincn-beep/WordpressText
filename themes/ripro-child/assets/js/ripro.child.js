//初始化
jQuery(function () {
    categoryBoxes();
})

//推荐专题模块js
function categoryBoxes() {
    jQuery(".child-container .category-boxes").owlCarousel({
        dots: !1,
        margin: 15,
        nav: !0,
        autoplay:!0,
        loop:true,
        navSpeed: 500,
        navText: navText,
        responsive: {0: {items: 2}, 768: {items: 2}, 992: {items: 3}, 1230: {items: 4}, 1340: {items: 5}}
    })
}