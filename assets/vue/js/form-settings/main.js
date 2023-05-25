import{c as x,o as f,a as g,b as e,w as V,v as $,n as k,r as w,d as S,S as U,s as y,e as T,f as d,t as n,g as r,h as i,u as s,i as B,j as E,k as z,l as A,m as j}from"../vendor/main.js";import{a as C,u as F,_ as G,p as M}from"../tailwind/main.js";import{_ as b}from"../Switch/main.js";import{_ as N}from"../PrimaryButton/main.js";import{_ as v}from"../ProBadge/main.js";const D={class:"flex mt-2"},R={class:"flex items-center"},K=["name","value","disabled"],I={class:"ml-2 text-sm"},P={id:"helper-radio-text",class:"text-xs font-normal text-gray-400"},m={__name:"RadioButton",props:["modelValue","name","disabled","value"],emits:["update:modelValue"],setup(u,{emit:p}){const _=u,c=x({get(){return _.modelValue},set(t){p("update:modelValue",t)}});return(t,a)=>(f(),g("div",D,[e("div",R,[V(e("input",{"onUpdate:modelValue":a[0]||(a[0]=l=>c.value=l),name:u.name,value:u.value,"aria-describedby":"helper-radio-text",type:"radio",class:"!w-4 !h-4 !text-blue-600 !bg-gray-100 !border-gray-300 !focus:ring-blue-500",disabled:u.disabled},null,8,K),[[$,c.value]])]),e("div",I,[e("label",{class:k(`font-medium ${u.disabled?"text-gray-300":"text-gray-900"}`)},[w(t.$slots,"default")],2),e("p",P,[w(t.$slots,"subtitle")])])]))}},W=S("FormSettingsStore",{state:()=>({formSettings:window.gpos.form_settings||[]}),actions:{async updateFormSettings(u){await C.post("update_form_settings",{settings:u}),U.fire({text:"Ayarlar kayıt edildi.",icon:"success",confirmButtonText:"Tamam",confirmButtonColor:"#1A56DB"})}}}),Y={class:"flex gap-32 bg-white p-6 rounded-lg shadow-md"},q={class:"w-3/12"},H={class:"flex flex-col gap-3"},J={class:"text-blue-600 font-bold text-md"},L=e("div",{class:"border border-[#E5E7EB]"},null,-1),O={class:"flex gap-2"},Q={class:"flex gap-2"},X={class:"w-9/12"},Z={class:"flex flex-col gap-3"},ee={class:"text-blue-600 font-bold text-md"},te=e("div",{class:"border border-[#E5E7EB]"},null,-1),se={class:"w-full flex gap-2 mt-2"},le={class:"w-1/2 flex gap-2"},ae={class:"w-1/2 flex gap-2 items-center"},oe={class:"mt-6 bg-white p-6 rounded-lg shadow-md"},de={class:"flex gap-32"},ie={class:"w-3/12"},ne={class:"flex flex-col gap-3"},re={class:"text-blue-600 font-bold text-md"},ue=e("div",{class:"border border-[#E5E7EB]"},null,-1),me={class:"flex gap-2"},_e={class:"w-9/12"},ce={class:"w-full h-64 border-2 rounded-lg border-dashed border-gray-200 bg-gray-50 flex items-stretch"},fe={class:"w-full flex justify-center self-center"},be={class:"flex flex-col gap-2"},ge={class:"flex gap-1 items-center"},pe=e("div",{class:"w-3 h-3 border-4 border-blue-600 bg-white rounded-full"},null,-1),ve={class:"font-bold"},he={key:0},we=e("div",{class:"h-10 bg-white border w-96 rounded-lg flex items-stretch"},[e("div",{class:"border-4 border-gray-200 rounded-lg w-1/2 self-center ml-2"})],-1),ye=e("div",{class:"w-full flex gap-2"},[e("div",{class:"h-10 bg-white border rounded-lg w-full flex items-stretch"},[e("div",{class:"border-4 border-gray-200 rounded-lg w-1/2 self-center ml-2"})]),e("div",{class:"h-10 bg-white border rounded-lg w-full flex items-stretch"},[e("div",{class:"border-4 border-gray-200 rounded-lg w-1/2 self-center ml-2"})])],-1),Ve=e("div",{class:"h-10 bg-blue-600 border w-96 rounded-lg flex justify-center items-stretch"},[e("div",{class:"border-4 border-gray-50 rounded-lg w-1/2 self-center"})],-1),xe=[we,ye,Ve],$e={key:1},ke=e("div",{class:"h-10 bg-white border w-full rounded-lg flex items-stretch mb-2"},[e("div",{class:"border-4 border-gray-200 rounded-lg w-1/2 self-center ml-2"})],-1),Se=e("div",{class:"h-10 bg-blue-600 border w-96 rounded-lg flex justify-center items-stretch"},[e("div",{class:"border-4 border-gray-50 rounded-lg w-1/2 self-center"})],-1),Ue=[ke,Se],Te={class:"my-6 bg-white p-6 rounded-lg shadow-md"},Be=e("span",{class:"text-blue-600 font-bold mb-2 text-md"},"Taksit Tablosu Görünüm Ayarları",-1),Ee={class:"w-full border-t flex gap-5 justify-between mt-2"},ze={class:"w-1/3 flex flex-col gap-3 mt-6"},Ae={class:"flex w-2/3 mt-2"},je={class:"w-1/2"},Ce={key:0,class:"w-1/2 mt-4"},Fe=e("label",{for:"message",class:"block mb-2 text-sm font-medium text-gray-900"},"Uyarı Metni",-1),Ge={class:"mt-12"},Me={__name:"App",setup(u){const p=F(),{isProActive:_}=y(p),c=W(),{formSettings:t}=y(c);return(a,l)=>(f(),T(G,{text:"Form ayarları",href:"https://yardim.gurmehub.com/docs/pos-entegrator/form-ayarlari/"},{default:d(()=>[e("div",Y,[e("div",q,[e("div",H,[e("span",J,n(a.$t("3d_settings")),1),L,e("div",O,[r(m,{modelValue:s(t).threed,"onUpdate:modelValue":l[0]||(l[0]=o=>s(t).threed=o),value:"none_threed",name:"3dsettings"},{subtitle:d(()=>[i(n(a.$t("not_3d_subtitle")),1)]),default:d(()=>[i(n(a.$t("not_3d")),1)]),_:1},8,["modelValue"])]),e("div",Q,[r(m,{modelValue:s(t).threed,"onUpdate:modelValue":l[1]||(l[1]=o=>s(t).threed=o),value:"optional_threed",name:"3dsettings"},{subtitle:d(()=>[i(n(a.$t("optional_3d_subtitle")),1)]),default:d(()=>[i(n(a.$t("optional_3d")),1)]),_:1},8,["modelValue"])]),r(m,{modelValue:s(t).threed,"onUpdate:modelValue":l[2]||(l[2]=o=>s(t).threed=o),value:"threed",name:"3dsettings"},{subtitle:d(()=>[i(n(a.$t("forced_3d_subtitle")),1)]),default:d(()=>[i(n(a.$t("forced_3d")),1)]),_:1},8,["modelValue"])])]),e("div",X,[e("div",Z,[e("span",ee,n(a.$t("other_settings")),1),te,e("div",se,[r(b,{modelValue:s(t).form_user_name,"onUpdate:modelValue":l[3]||(l[3]=o=>s(t).form_user_name=o),value:"form_user_name",class:"w-1/2"},{subtitle:d(()=>[i(n(a.$t("form_name_settings_subtitle")),1)]),default:d(()=>[i(n(a.$t("form_name_settings")),1)]),_:1},8,["modelValue"]),e("div",le,[r(b,{modelValue:s(t).save_card,"onUpdate:modelValue":l[4]||(l[4]=o=>s(t).save_card=o),value:"save_card",disabled:!s(_)},{subtitle:d(()=>[i(n(a.$t("save_card_settings_subtitle")),1)]),default:d(()=>[i(n(a.$t("save_card_settings")),1)]),_:1},8,["modelValue","disabled"]),r(v)])]),e("div",ae,[r(b,{modelValue:s(t).subscription,"onUpdate:modelValue":l[5]||(l[5]=o=>s(t).subscription=o),value:"subscription",disabled:!s(_),class:"mt-10"},{subtitle:d(()=>[i(n(a.$t("sub_payment_settings_subtitle")),1)]),default:d(()=>[i(n(a.$t("sub_payment_settings")),1)]),_:1},8,["modelValue","disabled"]),r(v)])])])]),e("div",oe,[e("div",de,[e("div",ie,[e("div",ne,[e("span",re,n(a.$t("view_settings")),1),ue,r(m,{modelValue:s(t).display_type,"onUpdate:modelValue":l[6]||(l[6]=o=>s(t).display_type=o),name:"display_type",value:"standart_form"},{subtitle:d(()=>[i(n(a.$t("standart_form_settings_subtitle")),1)]),default:d(()=>[i(n(a.$t("standart_form_settings")),1)]),_:1},8,["modelValue"]),e("div",me,[r(m,{modelValue:s(t).display_type,"onUpdate:modelValue":l[7]||(l[7]=o=>s(t).display_type=o),disabled:!s(_),name:"display_type",value:"oneline_form"},{subtitle:d(()=>[i(n(a.$t("online_form_settings_subtitle")),1)]),default:d(()=>[i(n(a.$t("oneline_form_settings")),1)]),_:1},8,["modelValue","disabled"]),r(v)])])]),e("div",_e,[e("div",ce,[e("div",fe,[e("div",be,[e("div",ge,[pe,e("span",ve,n(a.$t("pay_credit_cart")),1)]),s(t).display_type==="standart_form"?(f(),g("div",he,xe)):(f(),g("div",$e,Ue))])])])])])]),e("div",Te,[Be,e("div",Ee,[e("div",ze,[r(m,{modelValue:s(t).installment_wiev,"onUpdate:modelValue":l[8]||(l[8]=o=>s(t).installment_wiev=o),name:"installment_table_settings",value:"table_view"},{subtitle:d(()=>[i(" Taksit seçeneklerinizi ödeme formunda tablo şeklinde gösterir ")]),default:d(()=>[i(" Tablo Görünümü")]),_:1},8,["modelValue"]),r(m,{modelValue:s(t).installment_wiev,"onUpdate:modelValue":l[9]||(l[9]=o=>s(t).installment_wiev=o),name:"installment_table_settings",value:"row_view"},{subtitle:d(()=>[i(" Taksit seçeneklerinizi ödeme formunda satır şeklinde daha detaylı gösterir ")]),default:d(()=>[i(" Satır Görünümü")]),_:1},8,["modelValue"])]),e("div",Ae,[e("div",je,[r(b,{modelValue:s(t).no_installment_desc_status,"onUpdate:modelValue":l[10]||(l[10]=o=>s(t).no_installment_desc_status=o),value:"installment_desc",class:"mt-10"},{subtitle:d(()=>[i(" Taksitli satışa kapalı kategorileriniz için ödeme sayfasında müşterilerinize bir uyarı metni gösterebilirsiniz. (Yalnızca WooCommerce) ")]),default:d(()=>[i(" Taksitli Satışa Kapalı Kategoriler için Uyarı Göster")]),_:1},8,["modelValue"])]),s(t).no_installment_desc_status?(f(),g("div",Ce,[Fe,V(e("textarea",{id:"message","onUpdate:modelValue":l[11]||(l[11]=o=>s(t).no_installment_desc=o),rows:"6",class:"block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500",placeholder:"Açıklama giriniz..."},null,512),[[B,s(t).no_installment_desc]])])):E("",!0)])])]),e("div",Ge,[r(N,{onClick:l[12]||(l[12]=o=>s(c).updateFormSettings(s(t)))},{default:d(()=>[r(s(z),{class:"w-4 h-4 mr-2"}),i(" "+n(a.$t("save_settings")),1)]),_:1})])]),_:1}))}},Ne=A({locale:"default",messages:window.gpos.strings}),h=j(Me);h.use(M);h.use(Ne);h.mount("#app");
