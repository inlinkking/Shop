var map = new AMap.Map('container', {
    resizeEnable: true,
    zoom: 11
});
map.plugin(["AMap.ToolBar"], function () {
    map.addControl(new AMap.ToolBar());
    map.plugin(toolbar);
});

var contextMenu = new AMap.ContextMenu();  //创建右键菜单
//右键放大
contextMenu.addItem("放大一级", function () {
    map.zoomIn();
}, 0);
//右键缩小
contextMenu.addItem("缩小一级", function () {
    map.zoomOut();
}, 1);
//右键显示全国范围
contextMenu.addItem("缩放至全国范围", function (e) {
    map.setZoomAndCenter(4, [108.946609, 34.262324]);
}, 2);
//右键添加Marker标记
contextMenu.addItem("添加标记", function (e) {
    var marker = new AMap.Marker({
        map: map,
        position: contextMenuPositon //基点位置
    });
}, 3);

//地图绑定鼠标右击事件——弹出右键菜单
map.on('rightclick', function (e) {
    contextMenu.open(map, e.lnglat);
    contextMenuPositon = e.lnglat;
});
