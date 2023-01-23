@extends('admin.layout.master')
@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item active">Reports</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Reports</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-right d-inline-block">
                                <div class="btn-group mb-2">
                                    <button type="button" class="btn btn-xs btn-secondary">Today</button>
                                    <button type="button" class="btn btn-xs btn-light">Weekly</button>
                                    <button type="button" class="btn btn-xs btn-light">Monthly</button>
                                </div>
                            </div>
                            <h4 class="header-title">Users History</h4>
                            <div class="mt-3 chartjs-chart">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="projections-actuals-chart" data-colors="#ff7804,#cb5e00" width="1009" height="504" style="display: block;" class="chartjs-render-monitor"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body pb-2">
                            <div class="float-right d-inline-block">
                                <div class="btn-group mb-2">
                                    <button type="button" class="btn btn-xs btn-light">Today</button>
                                    <button type="button" class="btn btn-xs btn-light">Weekly</button>
                                    <button type="button" class="btn btn-xs btn-secondary">Monthly</button>
                                </div>
                            </div>
                            <h4 class="header-title mb-3">Messages History</h4>
                            <div dir="ltr" style="position: relative;">
                                <div id="sales-analytics" class="mt-4" data-colors="#ff7804,#cb5e00" style="min-height: 393px;">
                                    <div id="apexcharts546279" class="apexcharts-canvas apexcharts546279 apexcharts-theme-light apexcharts-zoomable" style="width: 1009px; height: 378px;">
                                        <svg id="SvgjsSvg1001" width="1009" height="378" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg hovering-zoom" xmlns:data="ApexChartsNS" transform="translate(0, 10)" style="background: transparent;">
                                            <g id="SvgjsG1003" class="apexcharts-inner apexcharts-graphical" transform="translate(39.25, 30)">
                                                <defs id="SvgjsDefs1002">
                                                    <clipPath id="gridRectMask546279">
                                                        <rect id="SvgjsRect1023" width="966.75" height="299.2" x="-3.5" y="-1.5" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect>
                                                    </clipPath>
                                                    <clipPath id="gridRectMarkerMask546279">
                                                        <rect id="SvgjsRect1024" width="963.75" height="300.2" x="-2" y="-2" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect>
                                                    </clipPath>
                                                    <linearGradient id="SvgjsLinearGradient1041" x1="0" y1="1" x2="1" y2="1">
                                                        <stop id="SvgjsStop1042" stop-opacity="0.75" stop-color="rgba(255,154,67,0.75)" offset="0"></stop>
                                                        <stop id="SvgjsStop1043" stop-opacity="0.75" stop-color="rgba(255,120,4,0.75)" offset="0"></stop>
                                                        <stop id="SvgjsStop1044" stop-opacity="0.75" stop-color="rgba(255,120,4,0.75)" offset="0"></stop>
                                                    </linearGradient>
                                                </defs>
                                                <line id="SvgjsLine1009" x1="610.25" y1="0" x2="610.25" y2="296.2" stroke="#b6b6b6" stroke-dasharray="3" class="apexcharts-xcrosshairs" x="610.25" y="0" width="1" height="296.2" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line>
                                                <g id="SvgjsG1046" class="apexcharts-xaxis" transform="translate(0, 0)">
                                                    <g id="SvgjsG1047" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)">
                                                        <text id="SvgjsText1049" font-family="Helvetica, Arial, sans-serif" x="21.8125" y="325.2" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="600" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan1050">Jan '00</tspan>
                                                            <title>Jan '00</title>
                                                        </text>
                                                        <text id="SvgjsText1052" font-family="Helvetica, Arial, sans-serif" x="109.0625" y="325.2" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan1053">02 Jan</tspan>
                                                            <title>02 Jan</title>
                                                        </text>
                                                        <text id="SvgjsText1055" font-family="Helvetica, Arial, sans-serif" x="196.3125" y="325.2" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan1056">03 Jan</tspan>
                                                            <title>03 Jan</title>
                                                        </text>
                                                        <text id="SvgjsText1058" font-family="Helvetica, Arial, sans-serif" x="283.5625" y="325.2" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan1059">04 Jan</tspan>
                                                            <title>04 Jan</title>
                                                        </text>
                                                        <text id="SvgjsText1061" font-family="Helvetica, Arial, sans-serif" x="370.8125" y="325.2" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan1062">05 Jan</tspan>
                                                            <title>05 Jan</title>
                                                        </text>
                                                        <text id="SvgjsText1064" font-family="Helvetica, Arial, sans-serif" x="458.0625" y="325.2" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan1065">06 Jan</tspan>
                                                            <title>06 Jan</title>
                                                        </text>
                                                        <text id="SvgjsText1067" font-family="Helvetica, Arial, sans-serif" x="545.3125" y="325.2" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan1068">07 Jan</tspan>
                                                            <title>07 Jan</title>
                                                        </text>
                                                        <text id="SvgjsText1070" font-family="Helvetica, Arial, sans-serif" x="632.5625" y="325.2" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan1071">08 Jan</tspan>
                                                            <title>08 Jan</title>
                                                        </text>
                                                        <text id="SvgjsText1073" font-family="Helvetica, Arial, sans-serif" x="719.8125" y="325.2" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan1074">09 Jan</tspan>
                                                            <title>09 Jan</title>
                                                        </text>
                                                        <text id="SvgjsText1076" font-family="Helvetica, Arial, sans-serif" x="807.0625" y="325.2" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan1077">10 Jan</tspan>
                                                            <title>10 Jan</title>
                                                        </text>
                                                        <text id="SvgjsText1079" font-family="Helvetica, Arial, sans-serif" x="894.3125" y="325.2" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan1080">11 Jan</tspan>
                                                            <title>11 Jan</title>
                                                        </text>
                                                        <text id="SvgjsText1082" font-family="Helvetica, Arial, sans-serif" x="981.5625" y="325.2" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan1083"></tspan>
                                                            <title></title>
                                                        </text>
                                                    </g>
                                                    <line id="SvgjsLine1084" x1="0" y1="297.2" x2="959.75" y2="297.2" stroke="#e0e0e0" stroke-dasharray="0" stroke-width="1"></line>
                                                </g>
                                                <g id="SvgjsG1097" class="apexcharts-grid">
                                                    <g id="SvgjsG1098" class="apexcharts-gridlines-horizontal">
                                                        <line id="SvgjsLine1111" x1="0" y1="0" x2="959.75" y2="0" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                        <line id="SvgjsLine1112" x1="0" y1="74.05" x2="959.75" y2="74.05" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                        <line id="SvgjsLine1113" x1="0" y1="148.1" x2="959.75" y2="148.1" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                        <line id="SvgjsLine1114" x1="0" y1="222.14999999999998" x2="959.75" y2="222.14999999999998" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                        <line id="SvgjsLine1115" x1="0" y1="296.2" x2="959.75" y2="296.2" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                    </g>
                                                    <g id="SvgjsG1099" class="apexcharts-gridlines-vertical"></g>
                                                    <line id="SvgjsLine1100" x1="21.8125" y1="297.2" x2="21.8125" y2="303.2" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                    <line id="SvgjsLine1101" x1="109.0625" y1="297.2" x2="109.0625" y2="303.2" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                    <line id="SvgjsLine1102" x1="196.3125" y1="297.2" x2="196.3125" y2="303.2" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                    <line id="SvgjsLine1103" x1="283.5625" y1="297.2" x2="283.5625" y2="303.2" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                    <line id="SvgjsLine1104" x1="370.8125" y1="297.2" x2="370.8125" y2="303.2" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                    <line id="SvgjsLine1105" x1="458.0625" y1="297.2" x2="458.0625" y2="303.2" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                    <line id="SvgjsLine1106" x1="545.3125" y1="297.2" x2="545.3125" y2="303.2" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                    <line id="SvgjsLine1107" x1="632.5625" y1="297.2" x2="632.5625" y2="303.2" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                    <line id="SvgjsLine1108" x1="719.8125" y1="297.2" x2="719.8125" y2="303.2" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                    <line id="SvgjsLine1109" x1="807.0625" y1="297.2" x2="807.0625" y2="303.2" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                    <line id="SvgjsLine1110" x1="894.3125" y1="297.2" x2="894.3125" y2="303.2" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                    <line id="SvgjsLine1117" x1="0" y1="296.2" x2="959.75" y2="296.2" stroke="transparent" stroke-dasharray="0"></line>
                                                    <line id="SvgjsLine1116" x1="0" y1="1" x2="0" y2="296.2" stroke="transparent" stroke-dasharray="0"></line>
                                                </g>
                                                <g id="SvgjsG1026" class="apexcharts-line-series apexcharts-plot-series">
                                                    <g id="SvgjsG1027" class="apexcharts-series" seriesName="Messages" data:longestSeries="true" rel="1" data:realIndex="0">
                                                        <path id="SvgjsPath1045" d="M0 181.01111111111112L87.25 24.683333333333337L174.5 82.27777777777777L261.75 148.1L349 16.455555555555577L436.25 189.23888888888888L523.5 230.3777777777778L610.75 115.1888888888889L698 189.23888888888888L785.25 189.23888888888888L872.5 271.51666666666665L959.75 238.60555555555555C959.75 238.60555555555555 959.75 238.60555555555555 959.75 238.60555555555555 " fill="none" fill-opacity="1" stroke="url(#SvgjsLinearGradient1041)" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-line" index="0" clip-path="url(#gridRectMask546279)" pathTo="M 0 181.01111111111112L 87.25 24.683333333333337L 174.5 82.27777777777777L 261.75 148.1L 349 16.455555555555577L 436.25 189.23888888888888L 523.5 230.3777777777778L 610.75 115.1888888888889L 698 189.23888888888888L 785.25 189.23888888888888L 872.5 271.51666666666665L 959.75 238.60555555555555" pathFrom="M -1 370.25L -1 370.25L 87.25 370.25L 174.5 370.25L 261.75 370.25L 349 370.25L 436.25 370.25L 523.5 370.25L 610.75 370.25L 698 370.25L 785.25 370.25L 872.5 370.25L 959.75 370.25"></path>
                                                        <g id="SvgjsG1028" class="apexcharts-series-markers-wrap">
                                                            <g class="apexcharts-series-markers">
                                                                <circle id="SvgjsCircle1123" r="0" cx="610.75" cy="115.1888888888889" class="apexcharts-marker wwhsbs6fo" stroke="#ffffff" fill="#ff7804" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle>
                                                            </g>
                                                        </g>
                                                    </g>
                                                    <g id="SvgjsG1029" class="apexcharts-datalabels" data:realIndex="0">
                                                        <g id="SvgjsG1030" class="apexcharts-data-labels"></g>
                                                        <g id="SvgjsG1031" class="apexcharts-data-labels"></g>
                                                        <g id="SvgjsG1032" class="apexcharts-data-labels"></g>
                                                        <g id="SvgjsG1033" class="apexcharts-data-labels"></g>
                                                        <g id="SvgjsG1034" class="apexcharts-data-labels"></g>
                                                        <g id="SvgjsG1035" class="apexcharts-data-labels"></g>
                                                        <g id="SvgjsG1036" class="apexcharts-data-labels"></g>
                                                        <g id="SvgjsG1037" class="apexcharts-data-labels"></g>
                                                        <g id="SvgjsG1038" class="apexcharts-data-labels"></g>
                                                        <g id="SvgjsG1039" class="apexcharts-data-labels"></g>
                                                        <g id="SvgjsG1040" class="apexcharts-data-labels"></g>
                                                    </g>
                                                </g>
                                                <line id="SvgjsLine1118" x1="0" y1="0" x2="959.75" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line>
                                                <line id="SvgjsLine1119" x1="0" y1="0" x2="959.75" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line>
                                                <g id="SvgjsG1120" class="apexcharts-yaxis-annotations"></g>
                                                <g id="SvgjsG1121" class="apexcharts-xaxis-annotations"></g>
                                                <g id="SvgjsG1122" class="apexcharts-point-annotations"></g>
                                                <rect id="SvgjsRect1124" width="0" height="0" x="0" y="0" rx="0" ry="0" fill="#fefefe" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" class="apexcharts-zoom-rect"></rect>
                                                <rect id="SvgjsRect1125" width="0" height="0" x="0" y="0" rx="0" ry="0" fill="#fefefe" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" class="apexcharts-selection-rect"></rect>
                                            </g>
                                            <rect id="SvgjsRect1008" width="0" height="0" x="0" y="0" rx="0" ry="0" fill="#fefefe" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect>
                                            <g id="SvgjsG1085" class="apexcharts-yaxis" rel="0" transform="translate(9.25, 0)">
                                                <g id="SvgjsG1086" class="apexcharts-yaxis-texts-g">
                                                    <text id="SvgjsText1087" font-family="Helvetica, Arial, sans-serif" x="20" y="31.4" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan1088">45</tspan>
                                                    </text>
                                                    <text id="SvgjsText1089" font-family="Helvetica, Arial, sans-serif" x="20" y="105.45" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan1090">36</tspan>
                                                    </text>
                                                    <text id="SvgjsText1091" font-family="Helvetica, Arial, sans-serif" x="20" y="179.5" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan1092">27</tspan>
                                                    </text>
                                                    <text id="SvgjsText1093" font-family="Helvetica, Arial, sans-serif" x="20" y="253.54999999999998" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan1094">18</tspan>
                                                    </text>
                                                    <text id="SvgjsText1095" font-family="Helvetica, Arial, sans-serif" x="20" y="327.59999999999997" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan1096">9</tspan>
                                                    </text>
                                                </g>
                                            </g>
                                            <g id="SvgjsG1004" class="apexcharts-annotations"></g>
                                        </svg>
                                        <div class="apexcharts-legend"></div>
                                        <div class="apexcharts-tooltip apexcharts-theme-light" style="left: 516.281px; top: 118.189px;">
                                            <div class="apexcharts-tooltip-title" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">07 Jan</div>
                                            <div class="apexcharts-tooltip-series-group apexcharts-active" style="display: flex;">
                                                <span class="apexcharts-tooltip-marker" style="background-color: rgb(255, 120, 4);"></span>
                                                <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                    <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label">Messages: </span><span class="apexcharts-tooltip-text-value">31</span></div>
                                                    <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="apexcharts-xaxistooltip apexcharts-xaxistooltip-bottom apexcharts-theme-light" style="left: 617.477px; top: 328.2px;">
                                            <div class="apexcharts-xaxistooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px; min-width: 42.0469px;">07 Jan</div>
                                        </div>
                                        <div class="apexcharts-toolbar" style="top: 0px; right: 3px;">
                                            <div class="apexcharts-zoomin-icon" title="Zoom In">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4V7zm-1-5C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"></path>
                                                </svg>
                                            </div>
                                            <div class="apexcharts-zoomout-icon" title="Zoom Out">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M7 11v2h10v-2H7zm5-9C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"></path>
                                                </svg>
                                            </div>
                                            <div class="apexcharts-zoom-icon apexcharts-selected" title="Selection Zoom">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" height="24" viewBox="0 0 24 24" width="24">
                                                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                                                    <path d="M0 0h24v24H0V0z" fill="none"></path>
                                                    <path d="M12 10h-2v2H9v-2H7V9h2V7h1v2h2v1z"></path>
                                                </svg>
                                            </div>
                                            <div class="apexcharts-pan-icon" title="Panning">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" height="24" viewBox="0 0 24 24" width="24">
                                                    <defs>
                                                        <path d="M0 0h24v24H0z" id="a"></path>
                                                    </defs>
                                                    <clipPath id="b">
                                                        <use overflow="visible" xlink:href="#a"></use>
                                                    </clipPath>
                                                    <path clip-path="url(#b)" d="M23 5.5V20c0 2.2-1.8 4-4 4h-7.3c-1.08 0-2.1-.43-2.85-1.19L1 14.83s1.26-1.23 1.3-1.25c.22-.19.49-.29.79-.29.22 0 .42.06.6.16.04.01 4.31 2.46 4.31 2.46V4c0-.83.67-1.5 1.5-1.5S11 3.17 11 4v7h1V1.5c0-.83.67-1.5 1.5-1.5S15 .67 15 1.5V11h1V2.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5V11h1V5.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5z"></path>
                                                </svg>
                                            </div>
                                            <div class="apexcharts-reset-icon" title="Reset Zoom">
                                                <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"></path>
                                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                                </svg>
                                            </div>
                                            <div class="apexcharts-menu-icon" title="Menu">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <path fill="none" d="M0 0h24v24H0V0z"></path>
                                                    <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"></path>
                                                </svg>
                                            </div>
                                            <div class="apexcharts-menu">
                                                <div class="apexcharts-menu-item exportSVG" title="Download SVG">Download SVG</div>
                                                <div class="apexcharts-menu-item exportPNG" title="Download PNG">Download PNG</div>
                                                <div class="apexcharts-menu-item exportCSV" title="Download CSV">Download CSV</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="resize-triggers">
                                    <div class="expand-trigger">
                                        <div style="width: 1010px; height: 394px;"></div>
                                    </div>
                                    <div class="contract-trigger"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.layout.footer')
        </div>
    </div>
    <div class="modal delete_modal fade" id="delete-popup" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="delete-cont">
                        <i class="far fa-times-circle"></i>
                        <h3>Are you sure?</h3>
                        <p>Are you sure you want to delete this record? This process cannot be undone</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <div class="rightbar-overlay"></div>
</div>
@endsection
@section('customScript')
<script src="{{ asset('assets/admin/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets/admin/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('assets/admin/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/admin/libs/selectize/js/standalone/selectize.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/pages/dashboard-1.init.js') }}"></script>
<script src="{{ asset('assets/admin/libs/chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/pages/dashboard-3.init.js') }}"></script>
<script src="{{ asset('assets/admin/js/app.min.js') }}"></script>
@endsection