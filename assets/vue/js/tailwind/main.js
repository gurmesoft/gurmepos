import{Y as b,o as n,a as c,b as e,g as r,u as a,Z as y,h as _,t as l,_ as v,$,a0 as C,z as k,d as f,s as m,S,a1 as B,j as h,a2 as T,Q as j,L as M,a3 as P,a4 as E,a5 as N,a6 as z,r as V,e as F}from"../vendor/main.js";const D=b(),U=C('<button class="relative" data-dropdown-toggle="dropdown"><div class="w-10 h-10 rounded-full bg-blue-600"></div><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="absolute -translate-y-1/2 -translate-x-1/2 top-2/4 left-1/2 text-white w-5 h-5"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm11.378-3.917c-.89-.777-2.366-.777-3.255 0a.75.75 0 01-.988-1.129c1.454-1.272 3.776-1.272 5.23 0 1.513 1.324 1.513 3.518 0 4.842a3.75 3.75 0 01-.837.552c-.676.328-1.028.774-1.028 1.152v.75a.75.75 0 01-1.5 0v-.75c0-1.279 1.06-2.107 1.875-2.502.182-.088.351-.199.503-.331.83-.727.83-1.857 0-2.584zM12 18a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd"></path></svg><span class="top-0 left-7 absolute w-3.5 h-3.5 bg-red-500 border-2 border-white rounded-full"></span></button>',1),O={id:"dropdown",class:"z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700"},Z={class:"py-2 text-sm text-gray-700 dark:text-gray-200","aria-labelledby":"dropdownDefaultButton"},A={href:"https://yardim.gurmehub.com/?utm_source=wp_plugin&utm_medium=organic&utm_campaign=baslangic",target:"_blank",class:"flex gap-2 items-center px-4 py-2 hover:bg-gray-100"},L={href:"https://posentegrator.frill.co/",target:"_blank",class:"flex gap-2 items-center px-4 py-2 hover:bg-gray-100"},G={href:"https://forum.gurmehub.com/c/gurmehub/pos-entegrator/31/?utm_source=wp_plugin&utm_medium=organic&utm_campaign=baslangic",target:"_blank",class:"flex gap-2 items-center px-4 py-2 hover:bg-gray-100"},H={__name:"HelpButton",setup(s){return(t,o)=>(n(),c("div",null,[U,e("div",O,[e("ul",Z,[e("li",null,[e("a",A,[r(a(y),{class:"w-4 h-4"}),_(" "+l(t.$t("help")),1)])]),e("li",null,[e("a",L,[r(a(v),{class:"w-4 h-4"}),_(l(t.$t("feedback")),1)])]),e("li",null,[e("a",G,[r(a($),{class:"w-4 h-4"}),_(" "+l(t.$t("forum")),1)])])])])]))}},J={id:"drawer-frill",class:"fixed top-0 right-0 z-40 h-screen overflow-y-auto transition-transform translate-x-full ml-5 bg-[#F5F6F6] flex flex-col w-1/4 !left-auto",tabindex:"-1","aria-labelledby":"drawer-label"},Q={class:"flex justify-between items-center mt-12 px-6"},q={class:"text-xl font-semibold"},R={class:"hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5","data-drawer-hide":"drawer-frill","aria-controls":"drawer-frill"},Y=e("div",{class:"px-4"},[e("iframe",{src:"https://posentegrator.frill.co/embed/widget/f23bcb78-dcc1-422e-8a23-e7aca8643455",sandbox:"allow-same-origin allow-scripts allow-top-navigation allow-popups allow-forms allow-popups-to-escape-sandbox",style:{border:"0px",outline:"0px",width:"100%",height:"100vh","margin-top":"10px"}})],-1),I={__name:"FrillBar",setup(s){return(t,o)=>(n(),c("div",J,[e("div",Q,[e("h1",q,l(t.$t("announcements")),1),e("button",R,[r(a(k),{class:"h-5 w-5"})])]),Y]))}},w=f("UiStore",{state:()=>({loading:!1})}),u=function(s,t,o){const i=window.gpos.prefix,d=window.gpos.nonce,p=`${window.ajaxurl}?action=${i}_${t}&_wpnonce=${d}`,{loading:g}=m(w(D));return window.jQuery.ajax({url:p,type:s,dataType:"json",contentType:"application/json",accept:"application/json",data:o?JSON.stringify(o):!1,beforeSend:()=>{g.value=!0},success:()=>{g.value=!1},error:x=>{g.value=!1,S.fire({text:x.responseJSON.error_message,icon:"error",confirmButtonText:window.gpos.alert_texts.ok,confirmButtonColor:"#C81E1E"})}})},K={get(s,t){return u("GET",s,t)},post(s,t){return u("POST",s,t)},delete(s,t){return u("DELETE",s,t)},put(s,t){return u("PUT",s,t)},patch(s,t){return u("PATCH",s,t)}},W=f("MainStore",{state:()=>({isProActive:window.gpos.is_pro_active,isTestMode:window.gpos.is_test_mode,paymentGateways:window.gpos.payment_gateways||[],pluginVersion:window.gpos.version}),actions:{async updateTestMode(s){return await K.post("update_test_mode",{test_mode:s})}}}),X={class:"flex justify-between items-center py-5 px-5 bg-white"},ee={class:"flex gap-2 items-center"},te={class:"flex items-center"},se=["src"],ae={class:"text-blue-800 text-xs font-medium -ml-2 mr-2"},oe={key:0,class:"bg-purple-100 text-purple-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded"},re={key:1,class:"bg-purple-100 text-purple-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded"},ne={class:"flex gap-5 items-center"},le={key:0,href:"https://posentegrator.com?utm_source=wp_plugin&utm_medium=organic&utm_campaign=ust_menu",target:"_blank",class:"text-sm flex gap-1 items-center text-[#6B7280]"},ie={class:"text-sm flex gap-1 items-center text-[#6B7280]","data-drawer-target":"drawer-frill","data-drawer-show":"drawer-frill","aria-controls":"drawer-frill","data-drawer-backdrop":"false"},ce={__name:"Navbar",setup(s){const t=window.gpos.assets_url,o=W(),{isProActive:i,pluginVersion:d}=m(o);return(p,g)=>(n(),c("div",null,[e("div",X,[e("div",ee,[e("div",te,[e("img",{src:`${a(t)}/images/logo.png`},null,8,se),e("span",ae,"v"+l(a(d)),1)]),a(i)?(n(),c("span",oe,"Pro")):(n(),c("span",re,l(p.$t("free")),1))]),e("div",ne,[a(i)?h("",!0):(n(),c("a",le,[r(a(B),{class:"w-4 h-4 text-blue-600"}),_(" "+l(p.$t("update_pro")),1)])),e("button",ie,[r(a(T),{class:"w-4 h-4"}),_(" "+l(p.$t("announcements")),1)]),r(H)])]),r(I)]))}},de={class:"w-full flex justify-center"},pe={class:"flex flex-col gap-2"},ue={class:"py-2 px-5 border rounded-full flex gap-2 bg-white items-center"},_e=["href"],ge={class:"w-full flex justify-center"},me={class:"flex gap-2 items-center mt-2"},he={href:"https://gurmehub.com/?utm_source=wp_plugin&utm_medium=organic&utm_campaign=footer",target:"_blank"},fe=["src"],we={__name:"Footer",props:["text","href"],setup(s){const t=s,o=window.gpos.assets_url;return(i,d)=>(n(),c("div",de,[e("div",pe,[e("div",ue,[r(a(j),{class:"w-5 h-5"}),e("span",null,[e("a",{href:t.href,target:"_blank",class:"text-blue-600"},l(i.$t("help_title_link",[t.text])),9,_e)])]),e("div",ge,[e("div",me,[e("a",he,[e("img",{src:`${a(o)}/images/gurmehub-footer.svg`,class:"w-max"},null,8,fe)])])])])]))}},xe={key:0,class:"fixed top-0 right-0 left-0 w-full h-full bg-gray-900 opacity-60",style:{"z-index":"999999"}},be={role:"status",class:"absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2"},ye=e("svg",{"aria-hidden":"true",class:"w-16 h-16 mr-2 text-gray-200 animate-spin fill-blue-600",viewBox:"0 0 100 101",fill:"none",xmlns:"http://www.w3.org/2000/svg"},[e("path",{d:"M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z",fill:"currentColor"}),e("path",{d:"M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z",fill:"currentFill"})],-1),ve={class:"sr-only"},$e={__name:"Loading",setup(s){const t=w(),{loading:o}=m(t);return(i,d)=>a(o)?(n(),c("div",xe,[e("div",be,[ye,e("span",ve,l(i.$t("loading")),1)])])):h("",!0)}};const Ce={class:"container mx-auto px-9 my-8"},Se={__name:"Page",props:{footer:{type:Boolean,default:!0},text:{type:String,default:"POS Entegratör"},href:{type:String,default:"https://yardim.gurmehub.com/docs/pos-entegrator/"}},setup(s){const t=s;return M(()=>{P(),E(),N(),z()}),(o,i)=>(n(),c("div",null,[r($e),r(ce),e("div",Ce,[V(o.$slots,"default")]),t.footer?(n(),F(we,{key:0,text:t.text,href:t.href},null,8,["text","href"])):h("",!0)]))}};export{Se as _,K as a,D as p,W as u};
