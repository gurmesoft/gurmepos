import{u as d,c as l,F as n,x as i,a as t,t as r,o,b as _,n as p,g as u,h as g,Q as x}from"./vendor-3-6-0.js";import{i as m}from"./admin-app-3-6-0.js";import"./store-3-6-0.js";const y={key:0,class:"w-full"},b={class:"flex flex-col relative"},h={key:0,class:"absolute z-20 -top-2 -right-1 bg-yellow-100 text-yellow-600 text-[10px] rounded px-2 py-1 w-max mr-1"},k={class:"text-[12px] break-all"},w=["href"],v={class:"text-[10px] text-gray-500"},N={class:"flex w-full flex-col mt-3"},V={class:"text-[10px]"},$={key:1},B={__name:"App",setup(C){const c=window.gpos.transactions,f=s=>{if(s.type==="cancel"||s.type==="refund")return s.status==="gpos_completed"?"bg-[#f0f9ff] text-[#0369a1]":"bg-gray-200 text-gray-700";if(s.type==="payment")return s.status==="gpos_completed"?"bg-green-200 text-green-700":"bg-red-200 text-red-700"};return(s,z)=>d(c)&&d(c).length>0?(o(),l("div",y,[(o(!0),l(n,null,i(d(c),e=>{var a;return o(),l("ul",{key:e.id,role:"list"},[t("li",b,[e.test?(o(),l("div",h," Test ")):_("",!0),t("div",{class:p(`${f(e)} p-2 flex items-center justify-between gap-1 rounded`)},[t("div",k,r((a=e.notes[0])==null?void 0:a.note),1),t("a",{class:"text-blue-700 flex items-center gap-1",target:"_blank",href:e.edit_link},[u("#"+r(e.id)+" ",1),g(d(x),{class:"w-4 h-4 text-blue-700"})],8,w)],2),t("span",v,r(e.date),1)])])}),128)),t("div",N,[(o(),l(n,null,i([{color:"bg-green-200",desc:"completed_payment"},{color:"bg-[#f0f9ff]",desc:"completed_refund"},{color:"bg-red-200",desc:"failed_payment"},{color:"bg-gray-200",desc:"failed_refund"}],(e,a)=>t("div",{key:a,class:"w-full p-1 flex gap-3 items-center"},[t("div",{class:p(`p-2 rounded ${e.color}`)},null,2),t("span",V,r(s.$t(e.desc)),1)])),64))])])):(o(),l("div",$,r(s.$t("transaction_not_found")),1))}};m(B,!1);
