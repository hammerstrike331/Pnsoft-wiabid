
var config = {
  '.chosen-select'           : {},
  '.chosen-select-deselect'  : { allow_single_deselect: true },
  '.chosen-select-no-single' : { disable_search_threshold: 10 },
  '.chosen-select-no-results': { no_results_text: 'Oops, nothing found!' },
  '.chosen-select-rtl'       : { rtl: true },
  '.chosen-select-width'     : { width: '95%' }
}
for (var selector in config) {
  $(selector).chosen(config[selector]);
}

function selectBL(selectedBL, inputBL) 
{
	if(selectedBL == "AUTO" ) {
		swal("입력된 Bl 번호(SDF)를 확인 할 수 없습니다. 해당 선사를 선택 후 입력해 주세요","","info");
		return ;
	}
	var param = "";
	var url = "";
	var sendForm = $("#trackingSubmit");
	var hidden1 = $("input#hidden1");
	var hidden2 = $("input#hidden2");
	var hidden3 = $("input#hidden3");
	var hidden4 = $("input#hidden4");
	var hidden5 = $("input#hidden5");
	var hidden6 = $("input#hidden6");

	if( selectedBL == "APL") {
		param = inputBL.substring(4, inputBL.length);
		url = "http://homeport.apl.com/gentrack/trackingMain.do?trackInput01=" + param;
	}
	else if( selectedBL == "ARK") {
		// param = inputBL.substring(4, inputBL.length);
		url = "https://tracking.arkasline.com.tr/ContainerTracking/";
	}
	else if( selectedBL == "CKL") {
		hidden1.attr("name", "cmd");
		hidden2.attr("name", "select_Gubun");
		hidden3.attr("name", "user_bkg_bl");
		hidden1.attr("value", "se");
		hidden2.attr("value", "sbkg_bl");
		hidden3.attr("value", inputBL);
		sendForm.attr("action", "http://www.ckline.co.kr/korea/service/se03.ck");
		sendForm.submit();
		return;
	}
	else if( selectedBL == "CMA") {
		url = "http://www.cma-cgm.com/ebusiness/tracking/search?SearchBy=BL&Reference=" + inputBL;
	}
	else if( selectedBL == "COA") {
		param = inputBL.substring(4, inputBL.length);
		url = "http://elines.coscoshipping.com/NewEBWeb/public/cargoTracking/cargoTracking.xhtml?CARGO_TRACKING_NUMBER_TYPE=BILLOFLADING&&REDIRECT=1&CARGO_TRACKING_NUMBER=" + param;
	}
	else if( selectedBL == "DJS") {
		hidden1.attr("name", "web_gubun");
		hidden2.attr("name", "search_type");
		hidden3.attr("name", "search_word");
		hidden1.attr("value", "w");
		hidden2.attr("value", "1");
		hidden3.attr("value", inputBL);
		sendForm.attr("action", "http://korea.djship.co.kr/dj/servlet/kr.eservice.action.sub3_20_Action?mode=S");
		sendForm.submit();
		return;
	}
	else if( selectedBL == "PCS") {
		hidden1.attr("name", "action");
		hidden2.attr("name", "type");
		hidden3.attr("name", "number");
		hidden1.attr("value", "search");
		hidden2.attr("value", "BL");
		hidden3.attr("value", inputBL);
		sendForm.attr("action", "http://www.pcsline.co.kr/ebusiness/ebusiness01.asp");
		sendForm.submit();
		return;
	}
	else if( selectedBL == "ESL") {
		hidden1.attr("name", "");
		hidden2.attr("name", "");
		hidden3.attr("name", "ctid");
		hidden1.attr("value", "");
		hidden2.attr("value", "");
		hidden3.attr("value", inputBL);
		sendForm.attr("action", "http://www.emiratesline.com/cargo-tracking");
		sendForm.submit();
		return;
	}
	else if( selectedBL == "EMC") {
		hidden1.attr("name", "TYPE");
		hidden2.attr("name", "SEL");
		hidden3.attr("name", "NO");
		hidden4.attr("name", "BL");
		hidden1.attr("value", "BL");
		hidden2.attr("value", "s_bl");
		hidden3.attr("value", inputBL);
		hidden4.attr("value", inputBL);
		sendForm.attr("action", "https://www.shipmentlink.com/servlet/TDB1_CargoTracking.do");
		sendForm.submit();
		return;
	}
	else if( selectedBL == "GSL") {
		url = "http://www.goldstarline.com/CCM.aspx?hidSearch=false&hidFromHomePage=false&hidSearchType=1&id=166&l=4&textContainerNumber=" + inputBL;
	}
	else if( selectedBL == "HSD") {
		url = "https://ecom.hamburgsud.com/ecom/en/ecommerce_portal/track_trace/track__trace/ep_trackandtrace.xhtml?lang=EN";
	}
	else if( selectedBL == "HLC") {
		url = "https://www.hapag-lloyd.com/en/online-business/tracing/tracing-by-booking.html?blno=" + inputBL;
	}
	else if( selectedBL == "HAS") {
		hidden1.attr("name", "numkind");
		hidden2.attr("name", "tag");
		hidden3.attr("name", "number");
		hidden1.attr("value", "1");
		hidden2.attr("value", "result");
		hidden3.attr("value", inputBL);
		sendForm.attr("action", "http://ebiz.heung-a.com/cargotrace.cfm");
		sendForm.submit();
		return;
	}
	else if( selectedBL == "HMM") {
		param = inputBL.substring(4, inputBL.length);
		url = "http://www.hmm21.com/cms/business/ebiz/trackTrace/trackTrace/index.jsp?is_quick=Y&quick_params=&type=1&submit.x=21&submit.y=10&number=" + param;
	}
	else if( selectedBL == "KMD") {
		param = inputBL.substring(4, inputBL.length);
		hidden1.attr("name", "dt_knd");
		hidden2.attr("name", "bl_no");
		hidden3.attr("name", "");
		hidden1.attr("value", "BL");
		hidden2.attr("value", param);
		hidden3.attr("value", "");
		sendForm.attr("action", "http://www.ekmtc.com/CCIT100/searchContainerList.do");
		sendForm.submit();
		return;
	}
	else if( selectedBL == "KKL") {
		url = "http://www.tradlinx.com/tracking";
	}
	else if( selectedBL == "MAE") {
		param = inputBL.substring(4, inputBL.length);
		url = "https://my.maerskline.com/trackingapp/zeroresult?searchNumber=" + param + "&hasError=false";
	}
	else if( selectedBL == "MOL") {
		param = inputBL.substring(4, inputBL.length);
		url = "http://web.molpower.com/Tracking/Main/Home?Typ=&Flg=Y&Dtls=" + param;
	}
	else if( selectedBL == "MSC") {
		url = "https://www.msc.com/track-a-shipment?agencyPath=kor";
	}
	else if( selectedBL == "MAT") {
		hidden1.attr("name", "submitButton");
		hidden2.attr("name", "billNumber");
		hidden3.attr("name", "");
		hidden1.attr("value", "submit");
		hidden2.attr("value", inputBL);
		hidden3.attr("value", "");
		sendForm.attr("action", "https://www.matson.com/vcsc/VisibilityController");
		sendForm.submit();
		return;
	}
	else if( selectedBL == "NYK") {
		param = inputBL.substring(4, inputBL.length);
		hidden1.attr("name", "trakNoParam");
		hidden2.attr("name", "cargoTrackingNo");
		hidden3.attr("name", "");
		hidden1.attr("value", param);
		hidden2.attr("value", param);
		hidden3.attr("value", "");
		sendForm.attr("action", "https://www.nykline.com/ecom/CUP_HOM_3301.do");
		sendForm.submit();
		return;
	}
	else if( selectedBL == "NSS") {
		hidden1.attr("name", "stype");
		hidden2.attr("name", "blNo");
		hidden3.attr("name", "cntrNo");
		hidden1.attr("value", "b");
		hidden2.attr("value", inputBL);
		hidden3.attr("value", "");
		sendForm.attr("action", "http://e.namsung.co.kr/frt/biz/eService/selectCargoTrace.do");
		sendForm.submit();
		return;
	}
	else if( selectedBL == "OOL") {
		url = "http://www.oocl.com/eng/ourservices/eservices/cargotracking/Pages/cargotracking.aspx";
	}
	else if( selectedBL == "PIL") {
		url = "https://www.pilship.com/--/120.html?&search_type=bl&refnumbers=" + inputBL;
	}
	else if( selectedBL == "PAN") {
		param = inputBL.substring(4, inputBL.length);
		hidden1.attr("name", "searchType");
		hidden2.attr("name", "schNum");
		hidden3.attr("name", "");
		hidden1.attr("value", "blNo");
		hidden2.attr("value", param);
		hidden3.attr("value", "");
		sendForm.attr("action", "http://container.panocean.com/HP2401/hp2401List.stx");
		sendForm.submit();
		return;
	}
	else if( selectedBL == "RCL") {
		url = "https://www.rclgroup.com/default.aspx";
	}
	else if( selectedBL == "SIT") {
		param = inputBL.substring(4, inputBL.length);
		url = "http://www.sitcline.com/index.jsp?viewId=menuItem_view_SmiCargoTrack&status=1&url=/track/biz/trackCargoTrack.do?method=bookingNoIndexNew&type=0&rblNo=" + inputBL;
	}
	else if( selectedBL == "SKR") {
		url = "http://eservice.sinokor.co.kr/ASPNETService/COM/CP_TrackingInquiry.aspx?BLNO=" + inputBL;
	}
	else if( selectedBL == "SNT") {
		url = "http://www.sinotrans.co.kr/eService/cargoHistory.asp?tid=103&sid=1&searchCategory=blno&keywords=" + inputBL;
	}
	else if( selectedBL == "TSL") {
		url = "http://afsys.tslines.com:8081/CargoTracking/CargoTrackingBL";
	}
	else if( selectedBL == "UAC") {
		param = inputBL.substring(4, inputBL.length);
		url = "http://uasconline.uasc.net/TrackingResults?itype=iTrack&callType=NoAjax&firstcall_track=no&Sequence=" + param;
	}
	else if( selectedBL == "WDF") {
		url = "https://cargo.weidong.com/imp/container/list.do?menuKey=186&searchSelect=blNo&searchValue=" + inputBL;
	}
	else if( selectedBL == "WHL") {
		url = "http://www.wanhai.com/views/cargoTrack/CargoTrack.xhtml";
	}
	else if( selectedBL == "YML") {
		url = "https://www.yangming.com/e-service/track_trace/blconnect.aspx?BLADG=" + inputBL;
	}
	else if( selectedBL == "ZIM") {
		url = "http://www.zim.com/pages/findcontainer.aspx?searchvalue1=" + inputBL;
	}

	window.open( url, '_blank' );
}

function selectedAir(selectedBL, inputBL) 
{
	if(selectedBL == "AUTO" ) {
		swal("입력된 AWB 번호()를 확인 할 수 없습니다. 해당 항공사를 선택 후 입력해 주세요","","info");
		return ;
	}
	var param = inputBL.split("-");
	var url = "";
	var sendForm = $("#trackingSubmit");
	var hidden1 = $("input#hidden1");
	var hidden2 = $("input#hidden2");
	var hidden3 = $("input#hidden3");
	var hidden4 = $("input#hidden4");
	var hidden5 = $("input#hidden5");
	var hidden6 = $("input#hidden6");
	var hidden7 = $("input#hidden7");
	var hidden8 = $("input#hidden8");
	var hidden9 = $("input#hidden9");
	var hidden10 = $("input#hidden10");
	var hidden11 = $("input#hidden11");

	if( selectedBL == "ACA") {
		url = "https://www.aircanada.com/cargo/en/tools-forms/?s_acn=" + param[0] + "&s_sref=" + param[1];
	}
	else if( selectedBL == "CCA") {
		url = "http://www.airchinacargo.com/en/index.php?section=0-0149-0154";
	}
	else if( selectedBL == "AFR") {
		url = "https://www.afklcargo.com/DK/en/local/app/index.jsp#/tntsinglesearch";
	}
	else if( selectedBL == "AIC") {
		url = "http://www.airindia.in/cargo-tracking.htm";
	}
	else if( selectedBL == "ABW") {
		hidden1.attr("name", "prefix");
		hidden2.attr("name", "trackid");
		hidden3.attr("name", "");
		hidden1.attr("value", param[0]);
		hidden2.attr("value", param[1]);
		hidden3.attr("value", "");
		sendForm.attr("action", "http://www.airbridgecargo.com/en/tracking/");
		sendForm.submit();
		return;
	}
	else if( selectedBL == "ANA") {
		url = "https://cargo.ana.co.jp/anaicoportal/portal/trackshipments?trkTxnValue=" + param[0] + "-" + param[1];
	}
	else if( selectedBL == "AAL") {
		hidden1.attr("name", "trackingPath");
		hidden2.attr("name", "airwayBills[0].awbCode");
		hidden3.attr("name", "airwayBills[0].awbNumber");
		hidden4.attr("name", "track10Search");

		hidden1.attr("value", "track10");
		hidden2.attr("value", param[0]);
		hidden3.attr("value", param[1]);
		hidden4.attr("value", "Track");
		sendForm.attr("action", "https://www.aacargo.com/AACargo/tracking");
		sendForm.submit();
		return;
	}
	else if( selectedBL == "AAR") {
		hidden1.attr("name", "comeByUrl");
		hidden2.attr("name", "mailLang");
		hidden3.attr("name", "Language");
		hidden4.attr("name", "prefix");
		hidden5.attr("name", "mawb");
		hidden6.attr("name", "globalLang");
		hidden7.attr("name", "Billno");
		hidden8.attr("name", "prefix2");
		hidden9.attr("name", "prefix3");
		hidden10.attr("name", "prefix4");
		hidden11.attr("name", "prefix5");

		hidden1.attr("value", "N");
		hidden2.attr("value", "Ko");
		hidden3.attr("value", "KOR");
		hidden4.attr("value", param[0]);
		hidden5.attr("value", param[1]);
		hidden6.attr("value", "Ko");
		hidden7.attr("value", param[1]);
		hidden8.attr("value", param[0]);
		hidden9.attr("value", param[0]);
		hidden10.attr("value", param[0]);
		hidden11.attr("value", param[0]);
		sendForm.attr("action", "https://www.asianacargo.com/tracking/newAirWaybill.do");
		sendForm.submit();
		return;
	}
	else if( selectedBL == "BAW") {
		url = "https://www.iagcargo.com/iagcargo/portlet/en/html/601";
	}
	else if( selectedBL == "CLX") {
		url = "http://www.cargolux.com/";
	}
	else if( selectedBL == "CPA") {
		url = "http://www.cathaypacificcargo.com/ManageYourShipment/TrackYourShipment/tabid/108/SingleAWBNo/" + inputBL + "/language/en-US/Default.aspx";
	}
	else if( selectedBL == "CAL") {
		url = "https://cargo.china-airlines.com/ccnetv2/content/manage/ShipmentTracking.aspx";
	}
	else if( selectedBL == "CES") {
		url = "http://cargo2.ce-air.com/MU/index.aspx";
	}
	else if( selectedBL == "CSN") {
		url = "http://cargo.csair.com/EN/WebFace/Tang.WebFace.Cargo/AgentAwbBrower.aspx?menuID=1";
	}
	else if( selectedBL == "DHK") {
		url = "https://dhli.dhl.com/dhli-client/publicTrackingSummary?31&searchType=BOLN&searchValue=" + param[0] + param[1];
	}
	else if( selectedBL == "DAL") {
		url = "https://www.deltacargo.com/Cargo/";
	}
	else if( selectedBL == "EVA") {
		url = "http://www.brcargo.com/ec_web/Default.aspx?Parm2=191&Parm3=?TNT_FLAG=Y&AWB_CODE="+ param[0] + "&MAWB_NUMBER=456" + param[1];
	}
	else if( selectedBL == "UAE") {
		hidden1.attr("name", "hdnFormID");
		hidden2.attr("name", "excludeServerValidation");
		hidden3.attr("name", "txtPrefix");
		hidden4.attr("name", "txtNumber");
		hidden5.attr("name", "txtAWBPrefix");

		hidden1.attr("value", "trackForm");
		hidden2.attr("value", "false");
		hidden3.attr("value", param[0]);
		hidden4.attr("value", param[1]);
		hidden5.attr("value", param[0]);
		sendForm.attr("action", "https://skychain.emirates.com/skychain/app");
		sendForm.submit();
		return;
	}
	else if( selectedBL == "ETD") {
		url = "https://www.etihadcargo.com/en-ae/track-and-trace.html";
	}
	else if( selectedBL == "FDX") {
		url = "https://www.fedex.com/apps/fedextrack/?action=track&cntry_code=kr&trackingnumber=" + param[0] + param[1];
	}
	else if( selectedBL == "GIA") {
		url = "https://cargo.garuda-indonesia.com/";
	}
	else if( selectedBL == "CHH") {
		url = "http://www.hnacargo.com/Portal2/Index.aspx";
	}
	else if( selectedBL == "CRK") {
		if( param[1] =='' ) param[1] = "0";
		url = "http://www.hkairlinescargo.com/CargoPortal/sreachYun/en_US/" + param[0] + "/" + param[1] + "/2/";
	}
	else if( selectedBL == "JAL") {
		hidden1.attr("name", "searchType");
		hidden2.attr("name", "awbNoPrefix1");
		hidden3.attr("name", "awbNoSuffix1");
		hidden4.attr("name", "continueButton.x");
		hidden5.attr("name", "continueButton.y");

		hidden1.attr("value", "00");
		hidden2.attr("value", param[0]);
		hidden3.attr("value", param[1]);
		hidden4.attr("value", "54");
		hidden5.attr("value", "14");
		sendForm.attr("action", "https://ww4.cargo.jal.co.jp/CargoWebTracing/en/intlTracingResult.do");
		sendForm.submit();
		return;
	}
	else if( selectedBL == "JJA") {
		url = "http://www.jejuaircargo.com/html/eng/sub3_1_list.asp?CarrierCode=" + param[0] + "&SearchMode.x=58&SearchMode.y=23&SearchMode=Search&BillNo=" + param[1];
	}
	else if( selectedBL == "JAI") {
		url = "https://cargo.jetairways.com/cargoview/default.aspx";
	}
	else if( selectedBL == "KLM") {
		url = "https://www.afklcargo.com/DK/en/local/app/index.jsp#/tntsinglesearch";
	}
	else if( selectedBL == "KAL") {
		url = "http://cargo.koreanair.com/ecus/trc/servlet/TrackingServlet";
	}
	else if( selectedBL == "TAM") {
		url = "http://www.latamcargo.com/en/e-tracking";
	}
	else if( selectedBL == "LAN") {
		url = "http://www.latamcargo.com/en/e-tracking";
	}
	else if( selectedBL == "GEC") {
		url = "https://lufthansa-cargo.com/eservices/etracking/awb-details/-/awb/" + param[0] + "/" + param[1];
	}
	else if( selectedBL == "MAS") {
		url = "http://www.maskargo.com/online_awb_info/index.php";
	}
	else if( selectedBL == "MPH") {
		url = "https://www.afklcargo.com/DK/en/local/app/index.jsp#/tntdetails/" + param[0] + "-" + param[1];
	}
	else if( selectedBL == "NCA") {
		url = "https://www.nca.aero/icoportal/jsp/operations/shipment/AWBTracking.jsf";
	}
	else if( selectedBL == "PAC") {
		url = "http://www.polaraircargo.com/TrackPhase2/WebForm1.aspx?pe=" + param[0] + "&se=" + param[1];
	}
	else if( selectedBL == "QFA") {
		url = "https://freight.qantas.com/";
	}
	else if( selectedBL == "QTR") {
		url = "http://qrcargo.com/trackshipment";
	}
	else if( selectedBL == "SWR") {
		url = "https://www.swissworldcargo.com/track_n_trace";
	}
	else if( selectedBL == "SVA") {
		url = "http://saudiacargo.com/freighter-schedules/trackship.php?submitBtn=Submit&pref=" + param[0] + "&number=" + param[1];
	}
	else if( selectedBL == "CSZ") {
		url = "http://cargo.shenzhenair.com/Query/AwbSearch.aspx";
	}
	else if( selectedBL == "SIA") {
		url = "http://www.siacargo.com/ccn/ShipmentTrack.aspx";
	}
	else if( selectedBL == "TAY") {
		url = "https://www.tnt.com/express/en_hk/site/shipping-tools/tracking.html?utm_redirect=en_gc_local";
	}
	else if( selectedBL == "THA") {
		url = "https://chorus.thaicargo.com/skychain/app?service=page/nwp:Trackshipmt";
	}
	else if( selectedBL == "THY") {
		url = "https://comisportal.thy.com/public/shipment-tracking-public/";
	}
	else if( selectedBL == "UAL") {
		url = "http://booking.unitedcargo.com/skychain/app?service=page/nwp:Trackshipmt";
	}
	else if( selectedBL == "UPS") {
		hidden1.attr("name", "loc");
		hidden2.attr("name", "awbNum");
		hidden3.attr("name", "track.x");
		hidden4.attr("name", "track.y");
		hidden5.attr("name", "");

		hidden1.attr("value", "en_US");
		hidden2.attr("value", param[0]+param[1]);
		hidden3.attr("value", "24");
		hidden4.attr("value", "2");
		hidden5.attr("value", "0");
		sendForm.attr("action", "https://www.ups.com/actrack/track/submit");
		sendForm.submit();
		return;
	}
	else if( selectedBL == "VIR") {
		url = "http://cargo.virgin-atlantic.com/gb/en/track-your-cargo/track-your-cargo.html?prefix=" + param[0] + "&number=" + param[1] + "&track=go";
	}

	window.open( url, '_blank' );
}

function insertKeycode(selectedBL) {

	if( selectedBL == "ACA") {
		$("#inputAirBill").val("014-");
	}
	else if( selectedBL == "CCA") {
		$("#inputAirBill").val("999-");
	}
	else if( selectedBL == "AFR") {
		$("#inputAirBill").val("057-");
	}
	else if( selectedBL == "AIC") {
		$("#inputAirBill").val("098-");
	}
	else if( selectedBL == "ABW") {
		$("#inputAirBill").val("580-");
	}
	else if( selectedBL == "ANA") {
		$("#inputAirBill").val("205-");
	}
	else if( selectedBL == "AAL") {
		$("#inputAirBill").val("001-");
	}
	else if( selectedBL == "AAR") {
		$("#inputAirBill").val("988-");
	}
	else if( selectedBL == "BAW") {
		$("#inputAirBill").val("125-");
	}
	else if( selectedBL == "CLX") {
		$("#inputAirBill").val("172-");
	}
	else if( selectedBL == "CPA") {
		$("#inputAirBill").val("160-");
	}
	else if( selectedBL == "CAL") {
		$("#inputAirBill").val("297-");
	}
	else if( selectedBL == "CES") {
		$("#inputAirBill").val("781-");
	}
	else if( selectedBL == "CSN") {
		$("#inputAirBill").val("784-");
	}
	else if( selectedBL == "DHK") {
		$("#inputAirBill").val("936-");
	}
	else if( selectedBL == "DAL") {
		$("#inputAirBill").val("006-");
	}
	else if( selectedBL == "EVA") {
		$("#inputAirBill").val("695-");
	}
	else if( selectedBL == "UAE") {
		$("#inputAirBill").val("176-");
	}
	else if( selectedBL == "ETD") {
		$("#inputAirBill").val("607-");
	}
	else if( selectedBL == "FDX") {
		$("#inputAirBill").val("023-");
	}
	else if( selectedBL == "GIA") {
		$("#inputAirBill").val("126-");
	}
	else if( selectedBL == "CHH") {
		$("#inputAirBill").val("880-");
	}
	else if( selectedBL == "CRK") {
		$("#inputAirBill").val("851-");
	}
	else if( selectedBL == "JAL") {
		$("#inputAirBill").val("131-");
	}
	else if( selectedBL == "JJA") {
		$("#inputAirBill").val("806-");
	}
	else if( selectedBL == "JAI") {
		$("#inputAirBill").val("589-");
	}
	else if( selectedBL == "KLM") {
		$("#inputAirBill").val("074-");
	}
	else if( selectedBL == "KAL") {
		$("#inputAirBill").val("180-");
	}
	else if( selectedBL == "TAM") {
		$("#inputAirBill").val("957-");
	}
	else if( selectedBL == "LAN") {
		$("#inputAirBill").val("045-");
	}
	else if( selectedBL == "GEC") {
		$("#inputAirBill").val("020-");
	}
	else if( selectedBL == "MAS") {
		$("#inputAirBill").val("232-");
	}
	else if( selectedBL == "MPH") {
		$("#inputAirBill").val("129-");
	}
	else if( selectedBL == "NCA") {
		$("#inputAirBill").val("933-");
	}
	else if( selectedBL == "PAC") {
		$("#inputAirBill").val("403-");
	}
	else if( selectedBL == "QFA") {
		$("#inputAirBill").val("081-");
	}
	else if( selectedBL == "QTR") {
		$("#inputAirBill").val("157-");
	}
	else if( selectedBL == "SWR") {
		$("#inputAirBill").val("724-");
	}
	else if( selectedBL == "SVA") {
		$("#inputAirBill").val("065-");
	}
	else if( selectedBL == "CSZ") {
		$("#inputAirBill").val("479-");
	}
	else if( selectedBL == "SIA") {
		$("#inputAirBill").val("618-");
	}
	else if( selectedBL == "TAY") {
		$("#inputAirBill").val("756-");
	}
	else if( selectedBL == "THA") {
		$("#inputAirBill").val("217-");
	}
	else if( selectedBL == "THY") {
		$("#inputAirBill").val("235-");
	}
	else if( selectedBL == "UAL") {
		$("#inputAirBill").val("016-");
	}
	else if( selectedBL == "UPS") {
		$("#inputAirBill").val("406-");
	}
	else if( selectedBL == "VIR") {
		$("#inputAirBill").val("932-");
	}
}

$(document).ready(function () {
	$( "select.chosen-select" ).change(function () 
	{
	    var value = $(this).find("option:selected").val();
	    insertKeycode(value);
	}).change();

	$("#btnBLSearch").click(function() {
		var inputBL = $("#inputBL").val();
		var selectedBL = $(this).parent().find("select.chosen-select option:selected").val();

	    selectBL(selectedBL, inputBL);

	});

	$("#btnAirSearch").click(function() {
		var inputBL = $("#inputAirBill").val();
		var selectedBL = $(this).parent().find("select.chosen-select option:selected").val();

	    selectedAir(selectedBL, inputBL) ;

	});	


});