import{o as p,c as f,a as d,r as w,b,w as D,v as J,n as k,d as _,e as s,f as m,t as r,g as i,u as c,h as L,i as H,j as I,S as K,s as j,k as N,l as Q,F as x,m as q,p as P,q as W,x as G,y as X,z as Y,A as Z,B as h,C as ee,D as te,E as le}from"../vendor/main.js";import{a as C,p as se}from"../ajax/main.js";import{_ as ae}from"../Page/main.js";import{_ as T}from"../_plugin-vue_export-helper/main.js";import{_ as F}from"../Switch/main.js";import{_ as oe}from"../PrimaryButton/main.js";/* empty css              */const ne={},ue={class:"w-full flex flex-col"},de={class:"w-full flex flex-wrap"},re={class:"w-full pt-8 px-3"};function ie(n,u){return p(),f("div",ue,[d("div",de,[w(n.$slots,"default")]),d("div",re,[w(n.$slots,"action")])])}const U=T(ne,[["render",ie]]),me={},pe={class:"flex flex-col gap-2 m-1 p-2 w-full"},ce={class:"w-full text-blue-600 font-bold text-md"},_e=d("div",{class:"border border-gray-100 mb-2"},null,-1);function fe(n,u){return p(),f("div",pe,[d("span",ce,[w(n.$slots,"header")]),_e,d("div",null,[w(n.$slots,"default")]),d("div",null,[w(n.$slots,"footer")])])}const v=T(me,[["render",fe]]),ge={class:"flex"},ve={class:"flex items-center"},$e=["id","name","value","disabled"],be={class:"ml-2 text-sm"},Ve=["for"],we={id:"helper-radio-text",class:"text-xs font-normal text-gray-400"},y={__name:"RadioButton",props:{modelValue:{type:String,required:!0},name:{type:String,required:!0},disabled:{type:Boolean,default:!1},value:{type:String,required:!0}},emits:["update:modelValue"],setup(n,{emit:u}){const a=n,l=b({get(){return a.modelValue},set(e){u("update:modelValue",e)}});return(e,t)=>(p(),f("div",ge,[d("div",ve,[D(d("input",{id:n.value,"onUpdate:modelValue":t[0]||(t[0]=o=>l.value=o),name:n.name,value:n.value,"aria-describedby":"helper-radio-text",type:"radio",class:"!w-4 !h-4 !text-blue-600 !bg-gray-100 !border-gray-300 !focus:ring-blue-500",disabled:n.disabled},null,8,$e),[[J,l.value]])]),d("div",be,[d("label",{for:n.value,class:k(`font-medium ${n.disabled?"text-gray-300":"text-gray-900"} flex items-center gap-2`)},[w(e.$slots,"default")],10,Ve),d("p",we,[w(e.$slots,"subtitle")])])]))}},ye={class:"flex flex-col gap-3"},he={class:"p-4 text-blue-600 border border-blue-200 rounded-lg bg-blue-50 w-full"},Se={__name:"Threed",props:{modelValue:{type:String,required:!0}},emits:["update:modelValue"],setup(n,{emit:u}){const a=n,l=b({get(){return a.modelValue},set(e){u("update:modelValue",e)}});return(e,t)=>(p(),_(v,null,{header:s(()=>[m(r(e.$t("3d_settings")),1)]),footer:s(()=>[d("div",he,r(e.$t("3d_settings_note")),1)]),default:s(()=>[d("div",ye,[i(y,{modelValue:l.value,"onUpdate:modelValue":t[0]||(t[0]=o=>l.value=o),value:"none_threed",name:"3dsettings"},{subtitle:s(()=>[m(r(e.$t("not_3d_subtitle")),1)]),default:s(()=>[m(r(e.$t("not_3d")),1)]),_:1},8,["modelValue"]),i(y,{modelValue:l.value,"onUpdate:modelValue":t[1]||(t[1]=o=>l.value=o),value:"optional_threed",name:"3dsettings"},{subtitle:s(()=>[m(r(e.$t("optional_3d_subtitle")),1)]),default:s(()=>[m(r(e.$t("optional_3d")),1)]),_:1},8,["modelValue"]),i(y,{modelValue:l.value,"onUpdate:modelValue":t[2]||(t[2]=o=>l.value=o),value:"force_threed",name:"3dsettings"},{subtitle:s(()=>[m(r(e.$t("forced_3d_subtitle")),1)]),default:s(()=>[m(r(e.$t("forced_3d")),1)]),_:1},8,["modelValue"])])]),_:1}))}},xe={class:"w-full flex flex-col gap-2"},Ue={class:"flex gap-2 items-center"},Ce={class:"bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded-lg flex gap-1 items-center h-6 max-h-max"},ke={__name:"Other",props:{modelValue:{type:Object,required:!0}},emits:["update:modelValue"],setup(n,{emit:u}){const a=n,l=b({get(){return a.modelValue},set(e){u("update:modelValue",e)}});return(e,t)=>(p(),_(v,null,{header:s(()=>[m(r(e.$t("other_settings")),1)]),default:s(()=>[d("div",xe,[i(F,{modelValue:l.value.holder_name_field,"onUpdate:modelValue":t[0]||(t[0]=o=>l.value.holder_name_field=o)},{subtitle:s(()=>[m(r(e.$t("form_name_settings_subtitle")),1)]),default:s(()=>[m(r(e.$t("form_name_settings")),1)]),_:1},8,["modelValue"]),i(F,{modelValue:l.value.use_iframe,"onUpdate:modelValue":t[1]||(t[1]=o=>l.value.use_iframe=o)},{subtitle:s(()=>[m(r(e.$t("use_iframe_settings_subtitle")),1)]),default:s(()=>[d("div",Ue,[m(r(e.$t("use_iframe_settings"))+" ",1),d("span",Ce,[i(c(L),{class:"w-3 h-3"}),m("Beta")])])]),_:1},8,["modelValue"])])]),_:1}))}},qe={},Fe={class:"bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded-lg flex gap-1 items-center h-6 max-h-max"};function je(n,u){return p(),f("span",Fe,r(n.$t("soon")),1)}const O=T(qe,[["render",je]]),Te={class:"flex w-full gap-6"},Ae={class:"flex w-1/3 flex-col gap-3"},Be={class:"flex w-2/3 items-center justify-center border-2 rounded-lg border-dashed border-gray-200 bg-gray-50 p-3"},We=["src"],De={__name:"Display",props:{modelValue:{type:String,required:!0}},emits:["update:modelValue"],setup(n,{emit:u}){const a=n,l=window.gpos.assets_url,e=b({get(){return a.modelValue},set(t){u("update:modelValue",t)}});return(t,o)=>(p(),_(v,null,{header:s(()=>[m(r(t.$t("view_settings")),1)]),default:s(()=>[d("div",Te,[d("div",Ae,[i(y,{modelValue:e.value,"onUpdate:modelValue":o[0]||(o[0]=g=>e.value=g),name:"display_type",value:"standart_form"},{subtitle:s(()=>[m(r(t.$t("standart_form_settings_subtitle")),1)]),default:s(()=>[m(r(t.$t("standart_form_settings")),1)]),_:1},8,["modelValue"]),i(y,{modelValue:e.value,"onUpdate:modelValue":o[1]||(o[1]=g=>e.value=g),disabled:"",name:"display_type",value:"oneline_form"},{subtitle:s(()=>[m(r(t.$t("online_form_settings_subtitle")),1)]),default:s(()=>[m(r(t.$t("oneline_form_settings"))+" ",1),i(O)]),_:1},8,["modelValue"])]),d("div",Be,[d("img",{src:`${c(l)}/images/settings/${e.value}.png`,class:"object-cover scale-75",alt:""},null,8,We)])])]),_:1}))}},Ne={class:"flex w-full gap-6"},Oe={class:"flex w-1/3 flex-col gap-3"},Ee={class:"flex w-2/3 items-center justify-center border-2 rounded-lg border-dashed border-gray-200 bg-gray-50"},Re=["src"],Me={__name:"Installment",props:{modelValue:{type:String,required:!0}},emits:["update:modelValue"],setup(n,{emit:u}){const a=n,l=window.gpos.assets_url,e=b({get(){return a.modelValue},set(t){u("update:modelValue",t)}});return(t,o)=>(p(),_(v,null,{header:s(()=>[m(r(t.$t("table_view_settings")),1)]),default:s(()=>[d("div",Ne,[d("div",Oe,[i(y,{modelValue:e.value,"onUpdate:modelValue":o[0]||(o[0]=g=>e.value=g),name:"installment_table_settings",value:"table_view"},{subtitle:s(()=>[m(r(t.$t("table_view_desc")),1)]),default:s(()=>[m(r(t.$t("table_view")),1)]),_:1},8,["modelValue"]),i(y,{modelValue:e.value,"onUpdate:modelValue":o[1]||(o[1]=g=>e.value=g),name:"installment_table_settings",value:"row_view"},{subtitle:s(()=>[m(r(t.$t("row_view_desc")),1)]),default:s(()=>[m(r(t.$t("row_view")),1)]),_:1},8,["modelValue"])]),d("div",Ee,[d("img",{src:`${c(l)}/images/settings/${e.value}.png`,class:"object-cover scale-75",alt:""},null,8,Re)])])]),_:1}))}},Pe={type:"button",class:"text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"},A={__name:"SaveButton",setup(n){return(u,a)=>(p(),f("button",Pe,[i(c(H),{class:"w-4 h-4 mr-2"}),m(" "+r(u.$t("save_settings")),1)]))}},B=I("SettingsStore",{state:()=>({wooCommerceSettings:window.gpos.woocommerce_settings||[],giveWpSettings:window.gpos.givewp_settings||[],formSettings:window.gpos.form_settings||[],cardSave:window.gpos.card_save_settings||[],wcSubsSettings:window.gpos.wc_subscription_settings||[]}),actions:{async updateWooCommerceSettings(){await C.post("update_woocommerce_settings",{settings:this.wooCommerceSettings}),this.swalFire()},async updateFormSettings(){await C.post("update_form_settings",{settings:this.formSettings}),this.swalFire()},async updateGiveWpSettings(){await C.post("update_givewp_settings",{settings:this.giveWpSettings}),this.swalFire()},async updateCardSaveSettings(){await C.post("update_card_save_settings",{settings:this.cardSave}),this.swalFire()},async updateWcSubsSettings(){await C.post("update_wc_subscription_settings",{settings:this.wcSubsSettings}),this.swalFire()},swalFire(){K.fire({text:window.gpos.alert_texts.setting_saved,icon:"success",confirmButtonText:window.gpos.alert_texts.ok,confirmButtonColor:"#1A56DB"})}}}),Ge={class:"w-1/2"},ze={class:"w-1/2"},Je={class:"w-full"},Le={class:"w-full"},R={__name:"FormSettings",setup(n){const u=B(),{formSettings:a}=j(u);return(l,e)=>(p(),_(U,null,{action:s(()=>[i(A,{onClick:e[4]||(e[4]=t=>c(u).updateFormSettings())})]),default:s(()=>[d("div",Ge,[i(Se,{modelValue:c(a).threed,"onUpdate:modelValue":e[0]||(e[0]=t=>c(a).threed=t)},null,8,["modelValue"])]),d("div",ze,[i(ke,{modelValue:c(a),"onUpdate:modelValue":e[1]||(e[1]=t=>N(a)?a.value=t:null)},null,8,["modelValue"])]),d("div",Je,[i(De,{modelValue:c(a).display_type,"onUpdate:modelValue":e[2]||(e[2]=t=>c(a).display_type=t)},null,8,["modelValue"])]),d("div",Le,[i(Me,{modelValue:c(a).installment_view,"onUpdate:modelValue":e[3]||(e[3]=t=>c(a).installment_view=t)},null,8,["modelValue"])])]),_:1}))}},He=["value","selected"],Ie={__name:"SuccessStatus",props:{modelValue:{type:String,required:!0}},emits:["update:modelValue"],setup(n,{emit:u}){const a=n,l=window.gpos.wc_order_statuses,e=b({get(){return a.modelValue},set(t){u("update:modelValue",t)}});return(t,o)=>(p(),f("label",null,[m(r(t.$t("pay_to_status"))+" ",1),D(d("select",{id:"countries","onUpdate:modelValue":o[0]||(o[0]=g=>e.value=g),class:"!bg-gray-50 border !border-gray-300 !text-gray-900 !text-sm !rounded-lg !focus:ring-blue-500 !focus:border-blue-500 !block !max-w-none !w-full !p-2.5"},[(p(!0),f(x,null,q(c(l),(g,V)=>(p(),f("option",{key:V,value:g.value,selected:g.value===e.value.success_status,class:"w-full"},r(g.text),9,He))),128))],512),[[Q,e.value]])]))}},Ke=["for"],Qe=["id","placeholder","required"],$={__name:"TextField",props:{modelValue:{type:String,required:!0},placeholder:{type:String,default:""},required:{type:Boolean,default:!1},id:{type:[String,Number],default:""},label:{type:String,default:""}},emits:["update:modelValue"],setup(n,{emit:u}){const a=n,l=b({get(){return a.modelValue},set(e){u("update:modelValue",e)}});return(e,t)=>(p(),f("label",{for:n.id},[m(r(n.label)+" ",1),D(d("input",{id:n.id,"onUpdate:modelValue":t[0]||(t[0]=o=>l.value=o),type:"text",class:"!bg-gray-50 !border !border-gray-300 !text-gray-900 !text-sm !rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full !p-3",placeholder:n.placeholder,required:n.required},null,8,Qe),[[P,l.value]])],8,Ke))}},Xe={class:"grid w-full grid-cols-2 gap-3"},Ye=["placeholder"],Ze={__name:"WooCommerce",setup(n){const u=B(),{wooCommerceSettings:a}=j(u);return(l,e)=>(p(),_(U,null,{action:s(()=>[i(A,{onClick:e[5]||(e[5]=t=>c(u).updateWooCommerceSettings())})]),default:s(()=>[i(v,null,{header:s(()=>[m(r(l.$t("form_texts")),1)]),default:s(()=>[d("div",Xe,[i($,{modelValue:c(a).title,"onUpdate:modelValue":e[0]||(e[0]=t=>c(a).title=t),label:l.$t("method_name"),placeholder:l.$t("your_method_name")},null,8,["modelValue","label","placeholder"]),i($,{modelValue:c(a).button_text,"onUpdate:modelValue":e[1]||(e[1]=t=>c(a).button_text=t),label:l.$t("pay_button_value"),placeholder:l.$t("pay_button_value")},null,8,["modelValue","label","placeholder"]),i(Ie,{modelValue:c(a).success_status,"onUpdate:modelValue":e[2]||(e[2]=t=>c(a).success_status=t)},null,8,["modelValue"]),i($,{modelValue:c(a).icon,"onUpdate:modelValue":e[3]||(e[3]=t=>c(a).icon=t),label:l.$t("icon"),placeholder:l.$t("icon")},null,8,["modelValue","label","placeholder"]),d("label",null,[m(r(l.$t("pay_form_desc"))+" ",1),D(d("textarea",{id:"message","onUpdate:modelValue":e[4]||(e[4]=t=>c(a).description=t),rows:"6",class:"block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500",placeholder:l.$t("enter_desc")},null,8,Ye),[[P,c(a).description]])])])]),_:1})]),_:1}))}},et={class:"grid w-full grid-cols-2 gap-3"},tt={class:"p-4 text-blue-600 border border-blue-200 rounded-lg bg-blue-50 w-full"},lt={__name:"DefaultCustomer",props:{modelValue:{type:Object,required:!0}},emits:["update:modelValue"],setup(n,{emit:u}){const a=n,l=b({get(){return a.modelValue},set(e){u("update:modelValue",e)}});return(e,t)=>(p(),_(v,null,{header:s(()=>[m(r(e.$t("default_donator")),1)]),footer:s(()=>[d("div",tt,r(e.$t("default_donator_desc")),1)]),default:s(()=>[d("div",et,[i($,{modelValue:l.value.first_name,"onUpdate:modelValue":t[0]||(t[0]=o=>l.value.first_name=o),label:e.$t("first_name"),placeholder:e.$t("first_name")},null,8,["modelValue","label","placeholder"]),i($,{modelValue:l.value.last_name,"onUpdate:modelValue":t[1]||(t[1]=o=>l.value.last_name=o),label:e.$t("last_name"),placeholder:e.$t("last_name")},null,8,["modelValue","label","placeholder"]),i($,{modelValue:l.value.phone,"onUpdate:modelValue":t[2]||(t[2]=o=>l.value.phone=o),label:e.$t("phone"),placeholder:e.$t("phone")},null,8,["modelValue","label","placeholder"]),i($,{modelValue:l.value.email,"onUpdate:modelValue":t[3]||(t[3]=o=>l.value.email=o),label:e.$t("email"),placeholder:e.$t("email")},null,8,["modelValue","label","placeholder"]),i($,{modelValue:l.value.address,"onUpdate:modelValue":t[4]||(t[4]=o=>l.value.address=o),label:e.$t("address"),placeholder:e.$t("address")},null,8,["modelValue","label","placeholder"]),i($,{modelValue:l.value.state,"onUpdate:modelValue":t[5]||(t[5]=o=>l.value.state=o),label:e.$t("state"),placeholder:e.$t("state")},null,8,["modelValue","label","placeholder"]),i($,{modelValue:l.value.city,"onUpdate:modelValue":t[6]||(t[6]=o=>l.value.city=o),label:e.$t("city"),placeholder:e.$t("city")},null,8,["modelValue","label","placeholder"]),i($,{modelValue:l.value.country,"onUpdate:modelValue":t[7]||(t[7]=o=>l.value.country=o),label:e.$t("country"),placeholder:e.$t("country")},null,8,["modelValue","label","placeholder"])])]),_:1}))}},st={class:"w-full"},at={__name:"GiveWp",setup(n){const u=B(),{giveWpSettings:a}=j(u);return(l,e)=>(p(),_(U,null,{action:s(()=>[i(A,{onClick:e[1]||(e[1]=t=>c(u).updateGiveWpSettings())})]),default:s(()=>[d("div",st,[i(lt,{modelValue:c(a).default_customer,"onUpdate:modelValue":e[0]||(e[0]=t=>c(a).default_customer=t)},null,8,["modelValue"])])]),_:1}))}},ot={__name:"Other",props:{modelValue:{type:Object,required:!0}},emits:["update:modelValue"],setup(n,{emit:u}){const a=n,l=b({get(){return a.modelValue},set(e){u("update:modelValue",e)}});return(e,t)=>(p(),_(v,null,{header:s(()=>[m(r(e.$t("other")),1)]),default:s(()=>[i($,{modelValue:l.value.save_info,"onUpdate:modelValue":t[0]||(t[0]=o=>l.value.save_info=o),label:e.$t("save_info"),placeholder:e.$t("note")},null,8,["modelValue","label","placeholder"])]),_:1}))}},nt={class:"flex justify-between"},ut={__name:"Support",props:{modelValue:{type:Object,required:!0}},emits:["update:modelValue"],setup(n,{emit:u}){const a=n,l=b({get(){return a.modelValue},set(e){u("update:modelValue",e)}});return(e,t)=>(p(),_(v,null,{header:s(()=>[m(r(e.$t("support_settings")),1)]),default:s(()=>[d("div",nt,[i(F,{modelValue:l.value.user_can_cancel,"onUpdate:modelValue":t[0]||(t[0]=o=>l.value.user_can_cancel=o)},{subtitle:s(()=>[m(r(e.$t("user_can_cancel_desc")),1)]),default:s(()=>[m(r(e.$t("activate")),1)]),_:1},8,["modelValue"]),l.value.user_can_cancel?(p(),_(F,{key:0,modelValue:l.value.user_can_change,"onUpdate:modelValue":t[1]||(t[1]=o=>l.value.user_can_change=o)},{subtitle:s(()=>[m(r(e.$t("user_can_cpm_desc")),1)]),default:s(()=>[m(r(e.$t("activate")),1)]),_:1},8,["modelValue"])):W("",!0)])]),_:1}))}},dt={class:"w-full"},rt={class:"w-full"},it={__name:"WcSubs",setup(n){const u=B(),{wcSubsSettings:a}=j(u);return(l,e)=>(p(),_(U,null,{action:s(()=>[i(A,{onClick:e[2]||(e[2]=t=>c(u).updateWcSubsSettings())})]),default:s(()=>[d("div",dt,[i(ut,{modelValue:c(a),"onUpdate:modelValue":e[0]||(e[0]=t=>N(a)?a.value=t:null)},null,8,["modelValue"])]),d("div",rt,[i(ot,{modelValue:c(a),"onUpdate:modelValue":e[1]||(e[1]=t=>N(a)?a.value=t:null)},null,8,["modelValue"])])]),_:1}))}},mt={},pt={class:"w-full h-full flex items-center justify-center text-[5rem] text-blue-600"};function ct(n,u){return p(),f("div",pt," Coming Soon ")}const _t=T(mt,[["render",ct]]),ft={__name:"Active",props:{modelValue:{type:Boolean,required:!0}},emits:["update:modelValue"],setup(n,{emit:u}){const a=n,l=b({get(){return a.modelValue},set(e){u("update:modelValue",e)}});return(e,t)=>(p(),_(v,null,{header:s(()=>[m(r(e.$t("saved_card")),1)]),default:s(()=>[i(F,{modelValue:l.value,"onUpdate:modelValue":t[0]||(t[0]=o=>l.value=o)},{subtitle:s(()=>[m(r(e.$t("saved_card_active")),1)]),default:s(()=>[m(r(e.$t("activate")),1)]),_:1},8,["modelValue"])]),_:1}))}},gt={class:"flex flex-col gap-3"},vt={__name:"SaveStep",props:{modelValue:{type:String,required:!0}},emits:["update:modelValue"],setup(n,{emit:u}){const a=n,l=b({get(){return a.modelValue},set(e){u("update:modelValue",e)}});return(e,t)=>(p(),_(v,null,{header:s(()=>[m(r(e.$t("save_step")),1)]),default:s(()=>[d("div",gt,[i(y,{modelValue:l.value,"onUpdate:modelValue":t[0]||(t[0]=o=>l.value=o),value:"at_payment",name:"save_step"},{subtitle:s(()=>[m(r(e.$t("at_payment_desc")),1)]),default:s(()=>[m(r(e.$t("at_payment")),1)]),_:1},8,["modelValue"]),i(y,{modelValue:l.value,"onUpdate:modelValue":t[1]||(t[1]=o=>l.value=o),value:"after_payment",name:"save_step",disabled:""},{subtitle:s(()=>[m(r(e.$t("after_payment_desc")),1)]),default:s(()=>[m(r(e.$t("after_payment")),1),i(O)]),_:1},8,["modelValue"])])]),_:1}))}},$t={class:"flex justify-between w-full border-2 rounded-lg border-dashed border-gray-200 bg-gray-50 p-3"},bt=d("span",null," [gpos_user_saved_cards] ",-1),Vt={key:1,class:"text-blue-600",textContent:"copied !"},wt={__name:"ShortCode",setup(n){let u=G(!0);const a=async l=>{await navigator.clipboard.writeText(l),u.value=!1,setTimeout(()=>{u.value=!0},1e3)};return(l,e)=>(p(),_(v,null,{header:s(()=>[m(r(l.$t("short_code")),1)]),footer:s(()=>[m(r(l.$t("save_card_short_code_desc")),1)]),default:s(()=>[d("div",$t,[bt,d("span",{class:"cursor-pointer",onClick:e[0]||(e[0]=t=>a("[gpos_user_saved_cards]"))},[c(u)?(p(),_(c(X),{key:0,class:"w-4 h-4 text-blue-600"})):(p(),f("span",Vt))])])]),_:1}))}},yt={class:"w-full"},ht={class:"w-1/2"},St={class:"w-1/2"},xt={__name:"CardSave",setup(n){const u=B(),{cardSave:a}=j(u);return(l,e)=>(p(),_(U,null,Y({default:s(()=>[d("div",yt,[i(ft,{modelValue:c(a).active,"onUpdate:modelValue":e[0]||(e[0]=t=>c(a).active=t),onChange:e[1]||(e[1]=t=>c(u).updateCardSaveSettings())},null,8,["modelValue"])]),c(a).active?(p(),f(x,{key:0},[d("div",ht,[i(vt,{modelValue:c(a).save_step,"onUpdate:modelValue":e[2]||(e[2]=t=>c(a).save_step=t)},null,8,["modelValue"])]),d("div",St,[i(wt)])],64)):W("",!0)]),_:2},[c(a).active?{name:"action",fn:s(()=>[i(A,{onClick:e[3]||(e[3]=t=>c(u).updateCardSaveSettings())})]),key:"0"}:void 0]),1024))}},Ut=["textContent"],Ct=["textContent"],kt={__name:"WordPress",setup(n){const u=window.gpos.status.wordpress;return(a,l)=>(p(),_(v,null,{header:s(()=>[m(" WordPress ")]),default:s(()=>[(p(!0),f(x,null,q(c(u),(e,t)=>(p(),f("div",{key:t,class:k(`flex flex-row items-center justify-between p-2 ${t%2===0?"bg-gray-100":""}`)},[d("span",{textContent:r(e.label)},null,8,Ut),d("span",{textContent:r(e.value)},null,8,Ct)],2))),128))]),_:1}))}},qt=["textContent"],Ft=["textContent"],jt={__name:"Server",setup(n){const u=window.gpos.status.server;return(a,l)=>(p(),_(v,null,{header:s(()=>[m(" Server ")]),default:s(()=>[(p(!0),f(x,null,q(c(u),(e,t)=>(p(),f("div",{key:t,class:k(`flex flex-row items-center justify-between p-2 ${t%2===0?"bg-gray-100":""}`)},[d("span",{textContent:r(e.label)},null,8,qt),d("span",{textContent:r(e.value)},null,8,Ft)],2))),128))]),_:1}))}},Tt={class:"w-full"},At={class:"w-full"},Bt={__name:"Status",setup(n){const u=()=>{Z(JSON.stringify(window.gpos.status),"status.json","text/json")};return(a,l)=>(p(),_(U,null,{action:s(()=>[i(oe,{onClick:l[0]||(l[0]=e=>u())},{default:s(()=>[m(r(a.$t("export")),1)]),_:1})]),default:s(()=>[d("div",Tt,[i(kt)]),d("div",At,[i(jt)])]),_:1}))}},Wt={},Dt={class:"pl-8 py-1 text-[10px] font-[700] uppercase"};function Nt(n,u){return p(),f("div",Dt,[w(n.$slots,"default")])}const Ot=T(Wt,[["render",Nt]]),Et=["src"],M={__name:"NavElement",props:{active:{type:Boolean,default:!1},icon:{type:String,required:!0}},setup(n){const u=window.gpos.assets_url;return(a,l)=>(p(),f("div",{class:k(`py-4 pl-8 border-l-4 cursor-pointer flex items-center font-medium text-sm
   ${n.active?" bg-white border-blue-800":"border-[#FAFAFA] bg-[#FAFAFA]"} `)},[d("img",{class:"w-5 h-5 mr-3 text-blue-600",src:`${c(u)}/images/settings/${n.icon}.svg`,alt:""},null,8,Et),d("div",{class:k(`${n.active?"text-black":"text-[#6E778A]"} flex gap-2 items-center`)},[w(a.$slots,"default")],2)],2))}},Rt={class:"w-full flex"},Mt={class:"w-1/5 flex flex-col bg-[#FAFAFA] py-8 rounded-l-lg space-y-8"},Pt={key:0,href:"https://yardim.gurmehub.com/docs/pos-entegrator/?utm_source=wp_plugin&utm_medium=referal&utm_campaign=documents",target:"_blank"},Gt={class:"w-4/5 flex flex-col bg-white rounded-r-lg p-8"},zt={__name:"App",setup(n){const u=window.gpos.integrations,a=window.gpos.is_pro_active,l=h(R),e=G([{sectionTitle:"general_settings",sections:[{title:"form_settings",icon:"queue-list-icon",active:!0,component:h(R)}]},{sectionTitle:"integration_settings",sections:[{title:"woocommerce",active:!1,component:h(Ze)},{title:"givewp",active:!1,component:h(at)},{title:"woocommerce_subs",active:!1,component:h(it)}]},{sectionTitle:"payment_settings",sections:[{title:"card_save",active:!1,component:h(xt)},{title:"installment_rules",active:!1,component:h(_t),soon:!0}]},{sectionTitle:"other",sections:[{title:"status",active:!1,component:h(Bt)}]}]);e.value[1].sections=e.value[1].sections.filter(o=>u[o.title]?u[o.title]:!1),e.value=e.value.filter(o=>o.sectionTitle==="payment_settings"?a:!0);const t=o=>{e.value.forEach(g=>{g.sections.forEach(V=>{V.active=V.title===o,V.title===o&&(l.value=V.component)})})};return(o,g)=>(p(),_(ae,{text:o.$t("settings"),href:"https://yardim.gurmehub.com/docs/pos-entegrator/?utm_source=wp_plugin&utm_medium=referal&utm_campaign=footer"},{default:s(()=>[d("div",Rt,[d("div",Mt,[(p(!0),f(x,null,q(e.value,V=>(p(),f("div",{key:V.sectionTitle},[i(Ot,null,{default:s(()=>[m(r(o.$t(V.sectionTitle)),1)]),_:2},1024),(p(!0),f(x,null,q(V.sections,(S,z)=>(p(),_(M,{key:z,icon:S.title,active:S.active,onClick:Lt=>S.soon?!1:t(S.title)},{default:s(()=>[m(r(o.$t(S.title))+" ",1),S.soon?(p(),_(O,{key:0})):W("",!0)]),_:2},1032,["icon","active","onClick"]))),128)),V.sectionTitle==="other"?(p(),f("a",Pt,[i(M,{icon:"documents",active:!1},{default:s(()=>[m(r(o.$t("documents")),1)]),_:1})])):W("",!0)]))),128))]),d("div",Gt,[(p(),_(ee(l.value)))])])]),_:1},8,["text"]))}},Jt=te({locale:"default",messages:window.gpos.strings,legacy:!1}),E=le(zt);E.use(se);E.use(Jt);E.mount("#app");
