import{o,c as n,a as e,g as l,u as a,a9 as g,f as d,t as i,aa as h,ab as f,ac as w,j as x,s as m,ad as y,l as u,_ as b,r as v,d as $}from"./vendor-undefined.js";import{a as C,u as k}from"./ajax-undefined.js";const S=w('<button class="relative" data-dropdown-toggle="dropdown"><div class="w-10 h-10 rounded-full bg-blue-600"></div><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="absolute -translate-y-1/2 -translate-x-1/2 top-2/4 left-1/2 text-white w-5 h-5"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm11.378-3.917c-.89-.777-2.366-.777-3.255 0a.75.75 0 01-.988-1.129c1.454-1.272 3.776-1.272 5.23 0 1.513 1.324 1.513 3.518 0 4.842a3.75 3.75 0 01-.837.552c-.676.328-1.028.774-1.028 1.152v.75a.75.75 0 01-1.5 0v-.75c0-1.279 1.06-2.107 1.875-2.502.182-.088.351-.199.503-.331.83-.727.83-1.857 0-2.584zM12 18a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd"></path></svg><span class="top-0 left-7 absolute w-3.5 h-3.5 bg-red-500 border-2 border-white rounded-full"></span></button>',1),B={id:"dropdown",class:"z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700"},M={class:"py-2 text-sm text-gray-700 dark:text-gray-200","aria-labelledby":"dropdownDefaultButton"},V={href:"https://yardim.gurmehub.com/?utm_source=wp_plugin&utm_medium=referal&utm_campaign=baslangic",target:"_blank",class:"flex gap-2 items-center px-4 py-2 hover:bg-gray-100"},N={href:"https://posentegrator.com/pos-entegrator-yol-haritasi/?utm_source=wp_plugin&utm_medium=referal&utm_campaign=baslangic",target:"_blank",class:"flex gap-2 items-center px-4 py-2 hover:bg-gray-100"},j={href:"https://forum.gurmehub.com/c/gurmehub/pos-entegrator/31/?utm_source=wp_plugin&utm_medium=referal&utm_campaign=baslangic",target:"_blank",class:"flex gap-2 items-center px-4 py-2 hover:bg-gray-100"},z={__name:"HelpButton",setup(s){return(t,r)=>(o(),n("div",null,[S,e("div",B,[e("ul",M,[e("li",null,[e("a",V,[l(a(g),{class:"w-4 h-4"}),d(" "+i(t.$t("help")),1)])]),e("li",null,[e("a",N,[l(a(h),{class:"w-4 h-4"}),d(i(t.$t("feedback")),1)])]),e("li",null,[e("a",j,[l(a(f),{class:"w-4 h-4"}),d(" "+i(t.$t("forum")),1)])])])])]))}},P=x("MainStore",{state:()=>({isTestMode:window.gpos.is_test_mode,paymentGateways:window.gpos.payment_gateways||[],pluginVersion:window.gpos.version}),actions:{async updateTestMode(s){return await C.post("update_test_mode",{test_mode:s})},gatewayCanRefund(s){const t=this.paymentGateways.find(r=>r.id===s.payment_gateway_id);return t&&t.supports.includes("refund")}}}),T={class:"flex justify-between items-center py-5 px-5 bg-white"},U={class:"flex gap-2 items-center"},Z={class:"flex items-center"},q=["src"],D={class:"text-blue-800 text-xs font-medium"},E={key:0,class:"bg-purple-100 text-purple-800 text-sm font-medium px-2.5 py-0.5 rounded"},F={key:1,class:"bg-purple-100 text-purple-800 text-sm font-medium px-2.5 py-0.5 rounded"},G={class:"flex gap-5 items-center"},R={key:0,href:"https://posentegrator.com?utm_source=wp_plugin&utm_medium=referal&utm_campaign=ust_menu",target:"_blank",class:"text-sm flex gap-1 items-center text-[#6B7280]"},A={__name:"Navbar",setup(s){const t=window.gpos.assets_url,r=P(),c=window.gpos.is_pro_active,{pluginVersion:p}=m(r);return(_,oe)=>(o(),n("div",null,[e("div",T,[e("div",U,[e("div",Z,[e("img",{class:"w-60",src:`${a(t)}/images/logo.svg`},null,8,q),e("span",D,"v"+i(a(p)),1)]),a(c)?(o(),n("span",E,"Pro")):(o(),n("span",F,i(_.$t("free")),1))]),e("div",G,[a(c)?u("",!0):(o(),n("a",R,[l(a(y),{class:"w-4 h-4 text-blue-600"}),d(" "+i(_.$t("update_pro")),1)])),l(z)])])]))}},H={class:"w-full flex justify-center"},L={class:"flex flex-col gap-2"},O={class:"py-2 px-5 border rounded-full flex gap-2 bg-white items-center"},I=["href"],J={class:"w-full flex justify-center"},K={class:"flex gap-2 items-center mt-2"},Q={href:"https://gurmehub.com/?utm_source=wp_plugin&utm_medium=referal&utm_campaign=footer",target:"_blank"},W=["src"],X={__name:"Footer",props:{text:{required:!0,type:String},href:{required:!0,type:String}},setup(s){const t=window.gpos.assets_url;return(r,c)=>(o(),n("div",H,[e("div",L,[e("div",O,[l(a(b),{class:"w-5 h-5"}),e("span",null,[e("a",{href:s.href,target:"_blank",class:"text-blue-600"},i(r.$t("help_title_link",[s.text])),9,I)])]),e("div",J,[e("div",K,[e("a",Q,[e("img",{src:`${a(t)}/images/gurmehub-footer.svg`,class:"w-32"},null,8,W)])])])])]))}},Y={key:0,class:"fixed top-0 right-0 left-0 w-full h-full bg-gray-900 opacity-60",style:{"z-index":"999999"}},ee={role:"status",class:"absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2"},te=e("svg",{"aria-hidden":"true",class:"w-16 h-16 mr-2 text-gray-200 animate-spin fill-blue-600",viewBox:"0 0 100 101",fill:"none",xmlns:"http://www.w3.org/2000/svg"},[e("path",{d:"M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z",fill:"currentColor"}),e("path",{d:"M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z",fill:"currentFill"})],-1),se={class:"sr-only"},ae={__name:"Loading",setup(s){const t=k(),{loading:r}=m(t);return(c,p)=>a(r)?(o(),n("div",Y,[e("div",ee,[te,e("span",se,i(c.$t("loading")),1)])])):u("",!0)}},re={class:"container mx-auto px-9 my-8"},ie={__name:"Page",props:{footer:{type:Boolean,default:!0},text:{type:String,default:"POS Entegratör"},href:{type:String,default:"https://yardim.gurmehub.com/docs/pos-entegrator/"}},setup(s){return(t,r)=>(o(),n("div",null,[l(ae),l(A),e("div",re,[v(t.$slots,"default")]),s.footer?(o(),$(X,{key:0,text:s.text,href:s.href},null,8,["text","href"])):u("",!0)]))}};export{ie as _,P as u};
