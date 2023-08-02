import{c as y,o as m,a as f,b as e,w as h,v as $,n as V,r as v,t as l,d as x,S,s as U,e as B,f as n,g as r,h as i,u as d,i as k,j as E,k as j,l as C,m as F}from"../vendor/main.js";import{a as N,_ as T,p as A}from"../tailwind/main.js";import{_ as g}from"../Switch/main.js";import{_ as D}from"../PrimaryButton/main.js";import{_ as R}from"../_plugin-vue_export-helper/main.js";const M={class:"flex mt-2"},z={class:"flex items-center"},I=["id","name","value","disabled"],q={class:"ml-2 text-sm"},G=["for"],H={id:"helper-radio-text",class:"text-xs font-normal text-gray-400"},_={__name:"RadioButton",props:["modelValue","name","disabled","value"],emits:["update:modelValue"],setup(u,{emit:c}){const o=u,t=y({get(){return o.modelValue},set(s){c("update:modelValue",s)}});return(s,a)=>(m(),f("div",M,[e("div",z,[h(e("input",{id:u.value,"onUpdate:modelValue":a[0]||(a[0]=w=>t.value=w),name:u.name,value:u.value,"aria-describedby":"helper-radio-text",type:"radio",class:"!w-4 !h-4 !text-blue-600 !bg-gray-100 !border-gray-300 !focus:ring-blue-500",disabled:u.disabled},null,8,I),[[$,t.value]])]),e("div",q,[e("label",{for:u.value,class:V(`font-medium ${u.disabled?"text-gray-300":"text-gray-900"}`)},[v(s.$slots,"default")],10,G),e("p",H,[v(s.$slots,"subtitle")])])]))}},J={},K={class:"bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded-lg flex gap-1 items-center h-6 max-h-max"};function L(u,c){return m(),f("span",K,l(u.$t("soon")),1)}const b=R(J,[["render",L]]),O=x("FormSettingsStore",{state:()=>({formSettings:window.gpos.form_settings||[]}),actions:{async updateFormSettings(u){await N.post("update_form_settings",{settings:u}),S.fire({text:window.gpos.alert_texts.setting_saved,icon:"success",confirmButtonText:window.gpos.alert_texts.ok,confirmButtonColor:"#1A56DB"})}}}),P={class:"flex gap-32 bg-white p-6 rounded-lg shadow-md"},Q={class:"w-3/12"},W={class:"flex flex-col gap-3"},X={class:"text-blue-600 font-bold text-md"},Y=e("div",{class:"border border-[#E5E7EB]"},null,-1),Z={class:"p-4 text-red-600 border border-red-200 rounded-lg bg-red-50 w-full"},ee={class:"flex gap-2"},te={class:"flex gap-2"},se={class:"w-9/12"},le={class:"flex flex-col gap-3"},oe={class:"text-blue-600 font-bold text-md"},de=e("div",{class:"border border-[#E5E7EB]"},null,-1),ae={class:"w-full flex gap-2 mt-2"},ne={class:"w-1/2 flex gap-2 items-center"},ie={class:"w-1/2 flex gap-2 items-center mt-10"},re={class:"mt-6 bg-white p-6 rounded-lg shadow-md"},ue={class:"flex gap-32"},_e={class:"w-3/12"},me={class:"flex flex-col gap-3"},ce={class:"text-blue-600 font-bold text-md"},fe=e("div",{class:"border border-[#E5E7EB]"},null,-1),ge={class:"flex gap-2 items-center"},be={class:"w-9/12"},pe={class:"w-full h-64 border-2 rounded-lg border-dashed border-gray-200 bg-gray-50 flex items-stretch"},ve={class:"w-full flex justify-center self-center"},he={class:"flex flex-col gap-2"},we={class:"flex gap-1 items-center"},ye=e("div",{class:"w-3 h-3 border-4 border-blue-600 bg-white rounded-full"},null,-1),$e={class:"font-bold"},Ve={key:0},xe=e("div",{class:"h-10 bg-white border w-96 rounded-lg flex items-stretch"},[e("div",{class:"border-4 border-gray-200 rounded-lg w-1/2 self-center ml-2"})],-1),Se=e("div",{class:"w-full flex gap-2"},[e("div",{class:"h-10 bg-white border rounded-lg w-full flex items-stretch"},[e("div",{class:"border-4 border-gray-200 rounded-lg w-1/2 self-center ml-2"})]),e("div",{class:"h-10 bg-white border rounded-lg w-full flex items-stretch"},[e("div",{class:"border-4 border-gray-200 rounded-lg w-1/2 self-center ml-2"})])],-1),Ue=e("div",{class:"h-10 bg-blue-600 border w-96 rounded-lg flex justify-center items-stretch"},[e("div",{class:"border-4 border-gray-50 rounded-lg w-1/2 self-center"})],-1),Be=[xe,Se,Ue],ke={key:1},Ee=e("div",{class:"h-10 bg-white border w-full rounded-lg flex items-stretch mb-2"},[e("div",{class:"border-4 border-gray-200 rounded-lg w-1/2 self-center ml-2"})],-1),je=e("div",{class:"h-10 bg-blue-600 border w-96 rounded-lg flex justify-center items-stretch"},[e("div",{class:"border-4 border-gray-50 rounded-lg w-1/2 self-center"})],-1),Ce=[Ee,je],Fe={class:"my-6 bg-white p-6 rounded-lg shadow-md"},Ne={class:"text-blue-600 font-bold mb-2 text-md"},Te={class:"w-full border-t flex gap-5 justify-between mt-2"},Ae={class:"w-1/3 flex flex-col gap-3 mt-6"},De={class:"flex w-2/3 mt-2"},Re={class:"w-1/2"},Me={key:0,class:"w-1/2 mt-4"},ze={for:"message",class:"block mb-2 text-sm font-medium text-gray-900"},Ie=["placeholder"],qe={class:"mt-12"},Ge={__name:"App",setup(u){const c=O(),{formSettings:o}=U(c);return(t,s)=>(m(),B(T,{text:t.$t("form_settings"),href:"https://yardim.gurmehub.com/docs/pos-entegrator/form-ayarlari/?utm_source=wp_plugin&utm_medium=organic&utm_campaign=footer"},{default:n(()=>[e("div",P,[e("div",Q,[e("div",W,[e("span",X,l(t.$t("3d_settings")),1),Y,e("div",Z,l(t.$t("3d_settings_note")),1),e("div",ee,[r(_,{modelValue:d(o).threed,"onUpdate:modelValue":s[0]||(s[0]=a=>d(o).threed=a),value:"none_threed",name:"3dsettings"},{subtitle:n(()=>[i(l(t.$t("not_3d_subtitle")),1)]),default:n(()=>[i(l(t.$t("not_3d")),1)]),_:1},8,["modelValue"])]),e("div",te,[r(_,{modelValue:d(o).threed,"onUpdate:modelValue":s[1]||(s[1]=a=>d(o).threed=a),value:"optional_threed",name:"3dsettings"},{subtitle:n(()=>[i(l(t.$t("optional_3d_subtitle")),1)]),default:n(()=>[i(l(t.$t("optional_3d")),1)]),_:1},8,["modelValue"])]),r(_,{modelValue:d(o).threed,"onUpdate:modelValue":s[2]||(s[2]=a=>d(o).threed=a),value:"threed",name:"3dsettings"},{subtitle:n(()=>[i(l(t.$t("forced_3d_subtitle")),1)]),default:n(()=>[i(l(t.$t("forced_3d")),1)]),_:1},8,["modelValue"])])]),e("div",se,[e("div",le,[e("span",oe,l(t.$t("other_settings")),1),de,e("div",ae,[r(g,{modelValue:d(o).form_user_name,"onUpdate:modelValue":s[3]||(s[3]=a=>d(o).form_user_name=a),value:"form_user_name",class:"w-1/2"},{subtitle:n(()=>[i(l(t.$t("form_name_settings_subtitle")),1)]),default:n(()=>[i(l(t.$t("form_name_settings")),1)]),_:1},8,["modelValue"]),e("div",ne,[r(g,{modelValue:d(o).save_card,"onUpdate:modelValue":s[4]||(s[4]=a=>d(o).save_card=a),value:"save_card",disabled:""},{subtitle:n(()=>[i(l(t.$t("save_card_settings_subtitle")),1)]),default:n(()=>[i(l(t.$t("save_card_settings")),1)]),_:1},8,["modelValue"]),r(b)])]),e("div",ie,[r(g,{modelValue:d(o).subscription,"onUpdate:modelValue":s[5]||(s[5]=a=>d(o).subscription=a),value:"subscription",disabled:""},{subtitle:n(()=>[i(l(t.$t("sub_payment_settings_subtitle")),1)]),default:n(()=>[i(l(t.$t("sub_payment_settings")),1)]),_:1},8,["modelValue"]),r(b)])])])]),e("div",re,[e("div",ue,[e("div",_e,[e("div",me,[e("span",ce,l(t.$t("view_settings")),1),fe,r(_,{modelValue:d(o).display_type,"onUpdate:modelValue":s[6]||(s[6]=a=>d(o).display_type=a),name:"display_type",value:"standart_form"},{subtitle:n(()=>[i(l(t.$t("standart_form_settings_subtitle")),1)]),default:n(()=>[i(l(t.$t("standart_form_settings")),1)]),_:1},8,["modelValue"]),e("div",ge,[r(_,{modelValue:d(o).display_type,"onUpdate:modelValue":s[7]||(s[7]=a=>d(o).display_type=a),disabled:"",name:"display_type",value:"oneline_form"},{subtitle:n(()=>[i(l(t.$t("online_form_settings_subtitle")),1)]),default:n(()=>[i(l(t.$t("oneline_form_settings")),1)]),_:1},8,["modelValue"]),r(b)])])]),e("div",be,[e("div",pe,[e("div",ve,[e("div",he,[e("div",we,[ye,e("span",$e,l(t.$t("pay_credit_cart")),1)]),d(o).display_type==="standart_form"?(m(),f("div",Ve,Be)):(m(),f("div",ke,Ce))])])])])])]),e("div",Fe,[e("span",Ne,l(t.$t("table_view_settings")),1),e("div",Te,[e("div",Ae,[r(_,{modelValue:d(o).installment_wiev,"onUpdate:modelValue":s[8]||(s[8]=a=>d(o).installment_wiev=a),name:"installment_table_settings",value:"table_view"},{subtitle:n(()=>[i(l(t.$t("table_view_desc")),1)]),default:n(()=>[i(l(t.$t("table_view")),1)]),_:1},8,["modelValue"]),r(_,{modelValue:d(o).installment_wiev,"onUpdate:modelValue":s[9]||(s[9]=a=>d(o).installment_wiev=a),name:"installment_table_settings",value:"row_view"},{subtitle:n(()=>[i(l(t.$t("row_view_desc")),1)]),default:n(()=>[i(l(t.$t("row_view")),1)]),_:1},8,["modelValue"])]),e("div",De,[e("div",Re,[r(g,{modelValue:d(o).no_installment_desc_status,"onUpdate:modelValue":s[10]||(s[10]=a=>d(o).no_installment_desc_status=a),value:"installment_desc",class:"mt-10"},{subtitle:n(()=>[i(l(t.$t("not_for_sale_installments_desc")),1)]),default:n(()=>[i(l(t.$t("not_for_sale_installments")),1)]),_:1},8,["modelValue"])]),d(o).no_installment_desc_status?(m(),f("div",Me,[e("label",ze,l(t.$t("warning_text")),1),h(e("textarea",{id:"message","onUpdate:modelValue":s[11]||(s[11]=a=>d(o).no_installment_desc=a),rows:"6",class:"block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500",placeholder:t.$t("enter_desc")},null,8,Ie),[[k,d(o).no_installment_desc]])])):E("",!0)])])]),e("div",qe,[r(D,{onClick:s[12]||(s[12]=a=>d(c).updateFormSettings(d(o)))},{default:n(()=>[r(d(j),{class:"w-4 h-4 mr-2"}),i(" "+l(t.$t("save_settings")),1)]),_:1})])]),_:1},8,["text"]))}},He=C({locale:"default",messages:window.gpos.strings,legacy:!1}),p=F(Ge);p.use(A);p.use(He);p.mount("#app");
