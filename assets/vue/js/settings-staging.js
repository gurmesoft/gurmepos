import{o as m,c as f,a,r as U,b as $,w as A,v as X,n as N,d as v,e as n,f as p,t as d,g as i,u as c,h as Y,i as Z,j as ee,S as te,s as j,k as M,l as T,m as R,p as H,F as x,q as k,x as B,y as le,z as se,A as oe,B as ae,C as ne,D as ue,E as de,G as re,H as F,I as ie,J as me,K as pe}from"./vendor-staging.js";import{a as D,p as ce}from"./ajax-staging.js";import{_ as _e}from"./Page-staging.js";import{_ as E}from"./_plugin-vue_export-helper-staging.js";import{_ as O}from"./Switch-staging.js";import{_ as K}from"./ProBadge-staging.js";import{_ as z}from"./PrimaryButton-staging.js";/* empty css             */const fe={},ve={class:"w-full flex flex-col"},ge={class:"w-full flex flex-wrap"},$e={class:"w-full pt-8 px-3"};function be(r,u){return m(),f("div",ve,[a("div",ge,[U(r.$slots,"default")]),a("div",$e,[U(r.$slots,"action")])])}const W=E(fe,[["render",be]]),Ve={},we={class:"flex flex-col gap-2 m-1 p-2 w-full"},ye={class:"w-full text-blue-600 font-bold text-md"},he=a("div",{class:"border border-gray-100 mb-2"},null,-1);function xe(r,u){return m(),f("div",we,[a("span",ye,[U(r.$slots,"header")]),he,a("div",null,[U(r.$slots,"default")]),a("div",null,[U(r.$slots,"footer")])])}const b=E(Ve,[["render",xe]]),Se={class:"flex"},Ce={class:"flex items-center"},Ue=["id","name","value","disabled"],ke={class:"ml-2 text-sm"},qe=["for"],je={id:"helper-radio-text",class:"text-xs font-normal text-gray-400"},w={__name:"RadioButton",props:{modelValue:{type:String,required:!0},name:{type:String,required:!0},disabled:{type:Boolean,default:!1},value:{type:String,required:!0}},emits:["update:modelValue"],setup(r,{emit:u}){const o=r,l=$({get(){return o.modelValue},set(e){u("update:modelValue",e)}});return(e,t)=>(m(),f("div",Se,[a("div",Ce,[A(a("input",{id:r.value,"onUpdate:modelValue":t[0]||(t[0]=s=>l.value=s),name:r.name,value:r.value,"aria-describedby":"helper-radio-text",type:"radio",class:"!w-4 !h-4 !text-blue-600 !bg-gray-100 !border-gray-300 !focus:ring-blue-500",disabled:r.disabled},null,8,Ue),[[X,l.value]])]),a("div",ke,[a("label",{for:r.value,class:N(`font-medium ${r.disabled?"text-gray-300":"text-gray-900"} flex items-center gap-2`)},[U(e.$slots,"default")],10,qe),a("p",je,[U(e.$slots,"subtitle")])])]))}},Fe={class:"flex flex-col gap-3"},Ae={class:"p-4 text-blue-600 border border-blue-200 rounded-lg bg-blue-50 w-full"},Te={__name:"Threed",props:{modelValue:{type:String,required:!0}},emits:["update:modelValue"],setup(r,{emit:u}){const o=r,l=$({get(){return o.modelValue},set(e){u("update:modelValue",e)}});return(e,t)=>(m(),v(b,null,{header:n(()=>[p(d(e.$t("3d_settings")),1)]),footer:n(()=>[a("div",Ae,d(e.$t("3d_settings_note")),1)]),default:n(()=>[a("div",Fe,[i(w,{modelValue:l.value,"onUpdate:modelValue":t[0]||(t[0]=s=>l.value=s),value:"none_threed",name:"3dsettings"},{subtitle:n(()=>[p(d(e.$t("not_3d_subtitle")),1)]),default:n(()=>[p(d(e.$t("not_3d")),1)]),_:1},8,["modelValue"]),i(w,{modelValue:l.value,"onUpdate:modelValue":t[1]||(t[1]=s=>l.value=s),value:"optional_threed",name:"3dsettings"},{subtitle:n(()=>[p(d(e.$t("optional_3d_subtitle")),1)]),default:n(()=>[p(d(e.$t("optional_3d")),1)]),_:1},8,["modelValue"]),i(w,{modelValue:l.value,"onUpdate:modelValue":t[2]||(t[2]=s=>l.value=s),value:"force_threed",name:"3dsettings"},{subtitle:n(()=>[p(d(e.$t("forced_3d_subtitle")),1)]),default:n(()=>[p(d(e.$t("forced_3d")),1)]),_:1},8,["modelValue"])])]),_:1}))}},Be={class:"w-full flex flex-col gap-2"},We={class:"flex gap-2 items-center"},De={class:"bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded-lg flex gap-1 items-center h-6 max-h-max"},Ne={__name:"Other",props:{modelValue:{type:Object,required:!0}},emits:["update:modelValue"],setup(r,{emit:u}){const o=r,l=$({get(){return o.modelValue},set(e){u("update:modelValue",e)}});return(e,t)=>(m(),v(b,null,{header:n(()=>[p(d(e.$t("other_settings")),1)]),default:n(()=>[a("div",Be,[i(O,{modelValue:l.value.holder_name_field,"onUpdate:modelValue":t[0]||(t[0]=s=>l.value.holder_name_field=s)},{subtitle:n(()=>[p(d(e.$t("form_name_settings_subtitle")),1)]),default:n(()=>[p(d(e.$t("form_name_settings")),1)]),_:1},8,["modelValue"]),i(O,{modelValue:l.value.use_iframe,"onUpdate:modelValue":t[1]||(t[1]=s=>l.value.use_iframe=s)},{subtitle:n(()=>[p(d(e.$t("use_iframe_settings_subtitle")),1)]),default:n(()=>[a("div",We,[p(d(e.$t("use_iframe_settings"))+" ",1),a("span",De,[i(c(Y),{class:"w-3 h-3"}),p("Beta")])])]),_:1},8,["modelValue"])])]),_:1}))}},Oe={},Pe={class:"bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded-lg flex gap-1 items-center h-6 max-h-max"};function Ee(r,u){return m(),f("span",Pe,d(r.$t("soon")),1)}const I=E(Oe,[["render",Ee]]),Me={class:"flex w-full gap-6"},Re={class:"flex w-1/3 flex-col gap-3"},ze={class:"flex w-2/3 items-center justify-center border-2 rounded-lg border-dashed border-gray-200 bg-gray-50 p-3"},Ge=["src"],Le={__name:"Display",props:{modelValue:{type:String,required:!0}},emits:["update:modelValue"],setup(r,{emit:u}){const o=r,l=window.gpos.assets_url,e=$({get(){return o.modelValue},set(t){u("update:modelValue",t)}});return(t,s)=>(m(),v(b,null,{header:n(()=>[p(d(t.$t("view_settings")),1)]),default:n(()=>[a("div",Me,[a("div",Re,[i(w,{modelValue:e.value,"onUpdate:modelValue":s[0]||(s[0]=_=>e.value=_),name:"display_type",value:"standart_form"},{subtitle:n(()=>[p(d(t.$t("standart_form_settings_subtitle")),1)]),default:n(()=>[p(d(t.$t("standart_form_settings")),1)]),_:1},8,["modelValue"]),i(w,{modelValue:e.value,"onUpdate:modelValue":s[1]||(s[1]=_=>e.value=_),disabled:"",name:"display_type",value:"oneline_form"},{subtitle:n(()=>[p(d(t.$t("online_form_settings_subtitle")),1)]),default:n(()=>[p(d(t.$t("oneline_form_settings"))+" ",1),i(I)]),_:1},8,["modelValue"])]),a("div",ze,[a("img",{src:`${c(l)}/images/settings/${e.value}.png`,class:"object-cover scale-75",alt:""},null,8,Ge)])])]),_:1}))}},Je={class:"flex w-full gap-6"},He={class:"flex w-1/3 flex-col gap-3"},Ke={class:"flex w-2/3 items-center justify-center border-2 rounded-lg border-dashed border-gray-200 bg-gray-50 p-3"},Ie=["src"],Qe={__name:"ExpiryDisplay",props:{modelValue:{type:String,required:!0}},emits:["update:modelValue"],setup(r,{emit:u}){const o=r,l=window.gpos.assets_url,e=$({get(){return o.modelValue},set(t){u("update:modelValue",t)}});return(t,s)=>(m(),v(b,null,{header:n(()=>[p(d(t.$t("expiry_field_style")),1)]),default:n(()=>[a("div",Je,[a("div",He,[i(w,{modelValue:e.value,"onUpdate:modelValue":s[0]||(s[0]=_=>e.value=_),name:"expiry_style",value:"select"},{default:n(()=>[p(d(t.$t("select_box")),1)]),_:1},8,["modelValue"]),i(w,{modelValue:e.value,"onUpdate:modelValue":s[1]||(s[1]=_=>e.value=_),name:"expiry_style",value:"text"},{default:n(()=>[p(d(t.$t("text_box")),1)]),_:1},8,["modelValue"])]),a("div",Ke,[a("img",{src:`${c(l)}/images/settings/expiry_${e.value}.png`,class:"object-cover scale-75",alt:""},null,8,Ie)])])]),_:1}))}},Xe={class:"flex w-full gap-6"},Ye={class:"flex w-1/3 flex-col gap-3"},Ze={class:"flex w-2/3 items-center justify-center border-2 rounded-lg border-dashed border-gray-200 bg-gray-50"},et=["src"],tt={__name:"Installment",props:{modelValue:{type:String,required:!0}},emits:["update:modelValue"],setup(r,{emit:u}){const o=r,l=window.gpos.assets_url,e=$({get(){return o.modelValue},set(t){u("update:modelValue",t)}});return(t,s)=>(m(),v(b,null,{header:n(()=>[p(d(t.$t("table_view_settings")),1)]),default:n(()=>[a("div",Xe,[a("div",Ye,[i(w,{modelValue:e.value,"onUpdate:modelValue":s[0]||(s[0]=_=>e.value=_),name:"installment_table_settings",value:"table_view"},{subtitle:n(()=>[p(d(t.$t("table_view_desc")),1)]),default:n(()=>[p(d(t.$t("table_view")),1)]),_:1},8,["modelValue"]),i(w,{modelValue:e.value,"onUpdate:modelValue":s[1]||(s[1]=_=>e.value=_),name:"installment_table_settings",value:"row_view"},{subtitle:n(()=>[p(d(t.$t("row_view_desc")),1)]),default:n(()=>[p(d(t.$t("row_view")),1)]),_:1},8,["modelValue"])]),a("div",Ze,[a("img",{src:`${c(l)}/images/settings/${e.value}.png`,class:"object-cover scale-75",alt:""},null,8,et)])])]),_:1}))}},lt={type:"button",class:"text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"},P={__name:"SaveButton",setup(r){return(u,o)=>(m(),f("button",lt,[i(c(Z),{class:"w-4 h-4 mr-2"}),p(" "+d(u.$t("save_settings")),1)]))}},q=ee("SettingsStore",{state:()=>({wooCommerceSettings:window.gpos.woocommerce_settings||[],giveWpSettings:window.gpos.givewp_settings||[],formSettings:window.gpos.form_settings||[],cardSave:window.gpos.card_save_settings||[],wcSubsSettings:window.gpos.wc_subscription_settings||[]}),actions:{async updateWooCommerceSettings(){await D.post("update_woocommerce_settings",{settings:this.wooCommerceSettings}),this.swalFire()},async updateFormSettings(){await D.post("update_form_settings",{settings:this.formSettings}),this.swalFire()},async updateGiveWpSettings(){await D.post("update_givewp_settings",{settings:this.giveWpSettings}),this.swalFire()},async updateCardSaveSettings(){await D.post("update_card_save_settings",{settings:this.cardSave}),this.swalFire()},async updateWcSubsSettings(){await D.post("update_wc_subscription_settings",{settings:this.wcSubsSettings}),this.swalFire()},swalFire(){te.fire({text:window.gpos.alert_texts.setting_saved,icon:"success",confirmButtonText:window.gpos.alert_texts.ok,confirmButtonColor:"#1A56DB"})}}}),st={class:"w-1/2"},ot={class:"w-1/2"},at={class:"w-full"},nt={class:"w-full"},ut={class:"w-full"},L={__name:"FormSettings",setup(r){const u=q(),{formSettings:o}=j(u);return(l,e)=>(m(),v(W,null,{action:n(()=>[i(P,{onClick:e[5]||(e[5]=t=>c(u).updateFormSettings())})]),default:n(()=>[a("div",st,[i(Te,{modelValue:c(o).threed,"onUpdate:modelValue":e[0]||(e[0]=t=>c(o).threed=t)},null,8,["modelValue"])]),a("div",ot,[i(Ne,{modelValue:c(o),"onUpdate:modelValue":e[1]||(e[1]=t=>M(o)?o.value=t:null)},null,8,["modelValue"])]),a("div",at,[i(Le,{modelValue:c(o).display_type,"onUpdate:modelValue":e[2]||(e[2]=t=>c(o).display_type=t)},null,8,["modelValue"])]),a("div",nt,[c(o).display_type==="standart_form"?(m(),v(Qe,{key:0,modelValue:c(o).expiry_style,"onUpdate:modelValue":e[3]||(e[3]=t=>c(o).expiry_style=t)},null,8,["modelValue"])):T("",!0)]),a("div",ut,[i(tt,{modelValue:c(o).installment_view,"onUpdate:modelValue":e[4]||(e[4]=t=>c(o).installment_view=t)},null,8,["modelValue"])])]),_:1}))}},dt=["for"],rt=["id","placeholder","required"],y={__name:"TextField",props:{modelValue:{type:String,required:!0},placeholder:{type:String,default:""},required:{type:Boolean,default:!1},id:{type:[String,Number],default:""},label:{type:String,default:""}},emits:["update:modelValue"],setup(r,{emit:u}){const o=r,l=$({get(){return o.modelValue},set(e){u("update:modelValue",e)}});return(e,t)=>(m(),f("label",{for:r.id},[p(d(r.label)+" ",1),A(a("input",{id:r.id,"onUpdate:modelValue":t[0]||(t[0]=s=>l.value=s),type:"text",class:"!bg-gray-50 !border !border-gray-300 !text-gray-900 !text-sm !rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full !p-3",placeholder:r.placeholder,required:r.required},null,8,rt),[[R,l.value]])],8,dt))}},it={class:"flex gap-7"},mt={class:"flex w-1/2 flex-wrap"},pt={class:"w-1/2"},ct=["placeholder"],_t={__name:"Form",setup(r){const{wooCommerceSettings:u}=j(q());return(o,l)=>(m(),v(b,null,{header:n(()=>[p(d(o.$t("form")),1)]),default:n(()=>[a("div",it,[a("div",mt,[i(y,{modelValue:c(u).button_text,"onUpdate:modelValue":l[0]||(l[0]=e=>c(u).button_text=e),class:"w-1/2 pr-2",label:o.$t("pay_button_value"),placeholder:o.$t("pay_button_value")},null,8,["modelValue","label","placeholder"]),i(y,{modelValue:c(u).title,"onUpdate:modelValue":l[1]||(l[1]=e=>c(u).title=e),class:"w-1/2 pl-2",label:o.$t("method_name"),placeholder:o.$t("your_method_name")},null,8,["modelValue","label","placeholder"]),i(y,{modelValue:c(u).icon,"onUpdate:modelValue":l[2]||(l[2]=e=>c(u).icon=e),class:"w-full mt-8",label:o.$t("icon"),placeholder:o.$t("icon")},null,8,["modelValue","label","placeholder"])]),a("label",pt,[p(d(o.$t("pay_form_desc"))+" ",1),A(a("textarea",{id:"message","onUpdate:modelValue":l[3]||(l[3]=e=>c(u).description=e),rows:"6",class:"block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500",placeholder:o.$t("enter_desc")},null,8,ct),[[R,c(u).description]])])])]),_:1}))}},ft=["value","selected"],vt={__name:"SuccessStatus",props:{modelValue:{type:String,required:!0}},emits:["update:modelValue"],setup(r,{emit:u}){const o=r,l=window.gpos.wc_order_statuses,e=$({get(){return o.modelValue},set(t){u("update:modelValue",t)}});return(t,s)=>(m(),f("label",null,[p(d(t.$t("pay_to_status"))+" ",1),A(a("select",{id:"countries","onUpdate:modelValue":s[0]||(s[0]=_=>e.value=_),class:"!bg-gray-50 border !border-gray-300 !text-gray-900 !text-sm !rounded-lg !focus:ring-blue-500 !focus:border-blue-500 !block !max-w-none !w-full !p-2.5"},[(m(!0),f(x,null,k(c(l),(_,g)=>(m(),f("option",{key:g,value:_.value,selected:_.value===e.value.success_status,class:"w-full"},d(_.text),9,ft))),128))],512),[[H,e.value]])]))}},gt={class:"flex"},$t={__name:"Order",setup(r){const{wooCommerceSettings:u}=j(q());return(o,l)=>(m(),v(b,null,{header:n(()=>[p(d(o.$t("order")),1)]),default:n(()=>[a("div",gt,[i(vt,{modelValue:c(u).success_status,"onUpdate:modelValue":l[0]||(l[0]=e=>c(u).success_status=e),class:"w-1/2"},null,8,["modelValue"])])]),_:1}))}},bt={class:"w-full"},Vt=["disabled"],wt={key:0,class:"z-10 relative"},yt={class:"absolute p-2 w-full bg-white rounded-lg shadow"},ht={class:"relative w-full flex items-center"},xt={class:"inline-flex items-center px-3 py-1 text-sm !border !border-r-0 border-gray-300 !rounded-l !rounded-r-none !bg-white"},St=["placeholder"],Ct={class:"h-48 overflow-y-auto text-sm text-gray-700 mt-2 bg-gray-50"},Ut={class:"flex items-center pl-2 rounded hover:bg-gray-100"},kt=["id","value"],qt=["for"],jt={class:"flex justify-end pt-2"},Ft={__name:"CatSelector",props:{modelValue:{type:Array,required:!0}},emits:["update:modelValue"],setup(r,{emit:u}){const o=r,l=window.gpos.is_pro_active,e=window.gpos.wc_categories||{},t=B(!1),s=B(""),_=$(()=>e.filter(h=>h.text.toLowerCase().includes(s.value.toLowerCase()))),g=$({get(){return o.modelValue},set(h){u("update:modelValue",h)}}),S=()=>e.filter(V=>g.value.includes(V.value)).map(V=>V.text).join(", ");return(h,V)=>(m(),f("div",bt,[a("button",{class:"w-full flex justify-between bg-white border font-medium rounded-lg text-sm px-5 py-2.5 text-center items-center",type:"button",disabled:!c(l),onClick:V[0]||(V[0]=C=>t.value=!t.value)},[p(d(g.value.length>0?S():h.$t("select_category"))+" ",1),t.value?(m(),v(c(le),{key:0,class:"h-4 w-4"})):(m(),v(c(se),{key:1,class:"h-4 w-4"}))],8,Vt),t.value?(m(),f("div",wt,[a("div",yt,[a("div",ht,[a("span",xt,[i(c(oe),{class:"w-5 h-5 text-blue-600"})]),A(a("input",{"onUpdate:modelValue":V[1]||(V[1]=C=>s.value=C),type:"text",class:"!rounded-r !border-y !border-r !border-l-0 !rounded-l-none !w-full !border-gray-300 !bg-white !m-0 focus:ring-0 focus:ring-offset-0",placeholder:h.$t("search")},null,8,St),[[R,s.value]])]),a("ul",Ct,[(m(!0),f(x,null,k(_.value,C=>(m(),f("li",{key:C.value},[a("div",Ut,[A(a("input",{id:C.value,"onUpdate:modelValue":V[2]||(V[2]=Q=>g.value=Q),type:"checkbox",value:C.value,class:"w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded"},null,8,kt),[[ae,g.value]]),a("label",{for:C.value,class:"w-full py-2 ml-2 text-sm font-medium text-gray-900 rounded"},d(C.text),9,qt)])]))),128))]),a("div",jt,[i(z,{onClick:V[3]||(V[3]=C=>t.value=!t.value)},{default:n(()=>[p(d(h.$t("select")),1)]),_:1})])])])):T("",!0)]))}},At=["value"],Tt={__name:"MaxSelect",props:{modelValue:{type:Number,required:!0}},emits:["update:modelValue"],setup(r,{emit:u}){const o=r,l=$({get(){return o.modelValue},set(e){u("update:modelValue",e)}});return(e,t)=>A((m(),f("select",{"onUpdate:modelValue":t[0]||(t[0]=s=>l.value=s),class:"flex border !border-gray-300 bg-white font-medium !rounded-lg text-sm px-5 py-2.5"},[(m(),f(x,null,k(12,s=>a("option",{key:s,value:s},d(s===1?e.$t("disable_inst"):s),9,At)),64))],512)),[[H,l.value]])}},Bt={class:"w-full text-sm text-left text-gray-500"},Wt={class:"text-xs text-gray-700 uppercase bg-gray-50"},Dt={key:0},Nt={scope:"row",class:"px-6 py-4 font-medium text-gray-900 whitespace-nowrap"},Ot={class:"px-6 py-4"},Pt={class:"px-6 py-4"},Et={key:1},Mt={class:"bg-white border-b"},Rt={class:"px-6 py-4 font-medium text-gray-900 whitespace-nowrap"},zt={__name:"DisabledTable",setup(r){const{wooCommerceSettings:u}=j(q()),o=window.gpos.wc_categories||{},l=e=>{var t;if(Object.keys(o).length>0)return(t=o.find(s=>parseInt(e)===s.value))==null?void 0:t.text};return(e,t)=>(m(),f("table",Bt,[a("thead",Wt,[a("tr",null,[(m(),f(x,null,k(["category","installment","remove"],s=>a("th",{key:s,scope:"col",class:"px-6 py-3"},d(e.$t(s)),1)),64))])]),Object.keys(c(u).installment_rules).length>0?(m(),f("tbody",Dt,[(m(!0),f(x,null,k(c(u).installment_rules,(s,_)=>(m(),f("tr",{key:_,class:"bg-white border-b"},[a("th",Nt,d(l(_)),1),a("td",Ot,d(s===1?e.$t("disable_inst"):s),1),a("td",Pt,[i(c(ne),{class:"h-6 w-6 cursor-pointer text-red-600",onClick:g=>delete c(u).installment_rules[_]},null,8,["onClick"])])]))),128))])):(m(),f("tbody",Et,[a("tr",Mt,[a("th",Rt,d(e.$t("no_rules")),1)])]))]))}},Gt={class:"flex items-center gap-2"},Lt={class:"w-full flex gap-7 relative"},Jt={class:"w-2/5 flex flex-col gap-4"},Ht={class:"w-full flex gap-2"},Kt={class:"w-3/5"},It={__name:"InstallmentRules",setup(r){const{wooCommerceSettings:u}=j(q()),o=window.gpos.is_pro_active,l=B([]),e=B(1),t=async()=>{await l.value.forEach(s=>u.value.installment_rules[s]=e.value),l.value=[],e.value=1};return(s,_)=>(m(),v(b,null,{header:n(()=>[a("div",Gt,[p(d(s.$t("installment_rules"))+" ",1),i(K)])]),default:n(()=>[a("div",Lt,[a("div",Jt,[i(Ft,{modelValue:l.value,"onUpdate:modelValue":_[0]||(_[0]=g=>l.value=g)},null,8,["modelValue"]),a("div",Ht,[i(Tt,{modelValue:e.value,"onUpdate:modelValue":_[1]||(_[1]=g=>e.value=g)},null,8,["modelValue"]),i(z,{disabled:!c(o),onClick:_[2]||(_[2]=g=>t())},{default:n(()=>[p(d(s.$t("apply")),1)]),_:1},8,["disabled"])])]),a("div",Kt,[i(zt)])])]),_:1}))}},Qt={__name:"WooCommerce",setup(r){const u=q();return(o,l)=>(m(),v(W,null,{action:n(()=>[i(P,{onClick:l[0]||(l[0]=e=>c(u).updateWooCommerceSettings())})]),default:n(()=>[i(_t),i($t),i(It)]),_:1}))}},Xt={class:"grid w-full grid-cols-2 gap-3"},Yt={class:"p-4 text-blue-600 border border-blue-200 rounded-lg bg-blue-50 w-full"},Zt={__name:"DefaultCustomer",props:{modelValue:{type:Object,required:!0}},emits:["update:modelValue"],setup(r,{emit:u}){const o=r,l=$({get(){return o.modelValue},set(e){u("update:modelValue",e)}});return(e,t)=>(m(),v(b,null,{header:n(()=>[p(d(e.$t("default_donator")),1)]),footer:n(()=>[a("div",Yt,d(e.$t("default_donator_desc")),1)]),default:n(()=>[a("div",Xt,[i(y,{modelValue:l.value.first_name,"onUpdate:modelValue":t[0]||(t[0]=s=>l.value.first_name=s),label:e.$t("first_name"),placeholder:e.$t("first_name")},null,8,["modelValue","label","placeholder"]),i(y,{modelValue:l.value.last_name,"onUpdate:modelValue":t[1]||(t[1]=s=>l.value.last_name=s),label:e.$t("last_name"),placeholder:e.$t("last_name")},null,8,["modelValue","label","placeholder"]),i(y,{modelValue:l.value.phone,"onUpdate:modelValue":t[2]||(t[2]=s=>l.value.phone=s),label:e.$t("phone"),placeholder:e.$t("phone")},null,8,["modelValue","label","placeholder"]),i(y,{modelValue:l.value.email,"onUpdate:modelValue":t[3]||(t[3]=s=>l.value.email=s),label:e.$t("email"),placeholder:e.$t("email")},null,8,["modelValue","label","placeholder"]),i(y,{modelValue:l.value.address,"onUpdate:modelValue":t[4]||(t[4]=s=>l.value.address=s),label:e.$t("address"),placeholder:e.$t("address")},null,8,["modelValue","label","placeholder"]),i(y,{modelValue:l.value.state,"onUpdate:modelValue":t[5]||(t[5]=s=>l.value.state=s),label:e.$t("state"),placeholder:e.$t("state")},null,8,["modelValue","label","placeholder"]),i(y,{modelValue:l.value.city,"onUpdate:modelValue":t[6]||(t[6]=s=>l.value.city=s),label:e.$t("city"),placeholder:e.$t("city")},null,8,["modelValue","label","placeholder"]),i(y,{modelValue:l.value.country,"onUpdate:modelValue":t[7]||(t[7]=s=>l.value.country=s),label:e.$t("country"),placeholder:e.$t("country")},null,8,["modelValue","label","placeholder"])])]),_:1}))}},el={class:"w-full"},tl={__name:"GiveWp",setup(r){const u=q(),{giveWpSettings:o}=j(u);return(l,e)=>(m(),v(W,null,{action:n(()=>[i(P,{onClick:e[1]||(e[1]=t=>c(u).updateGiveWpSettings())})]),default:n(()=>[a("div",el,[i(Zt,{modelValue:c(o).default_customer,"onUpdate:modelValue":e[0]||(e[0]=t=>c(o).default_customer=t)},null,8,["modelValue"])])]),_:1}))}},ll={__name:"Other",props:{modelValue:{type:Object,required:!0}},emits:["update:modelValue"],setup(r,{emit:u}){const o=r,l=$({get(){return o.modelValue},set(e){u("update:modelValue",e)}});return(e,t)=>(m(),v(b,null,{header:n(()=>[p(d(e.$t("other")),1)]),default:n(()=>[i(y,{modelValue:l.value.save_info,"onUpdate:modelValue":t[0]||(t[0]=s=>l.value.save_info=s),label:e.$t("save_info"),placeholder:e.$t("note")},null,8,["modelValue","label","placeholder"])]),_:1}))}},sl={class:"flex justify-between"},ol={__name:"Support",props:{modelValue:{type:Object,required:!0}},emits:["update:modelValue"],setup(r,{emit:u}){const o=r,l=$({get(){return o.modelValue},set(e){u("update:modelValue",e)}});return(e,t)=>(m(),v(b,null,{header:n(()=>[p(d(e.$t("support_settings")),1)]),default:n(()=>[a("div",sl,[i(O,{modelValue:l.value.user_can_cancel,"onUpdate:modelValue":t[0]||(t[0]=s=>l.value.user_can_cancel=s)},{subtitle:n(()=>[p(d(e.$t("user_can_cancel_desc")),1)]),default:n(()=>[p(d(e.$t("activate")),1)]),_:1},8,["modelValue"]),l.value.user_can_cancel?(m(),v(O,{key:0,modelValue:l.value.user_can_change,"onUpdate:modelValue":t[1]||(t[1]=s=>l.value.user_can_change=s)},{subtitle:n(()=>[p(d(e.$t("user_can_cpm_desc")),1)]),default:n(()=>[p(d(e.$t("activate")),1)]),_:1},8,["modelValue"])):T("",!0)])]),_:1}))}},al={class:"w-full"},nl={class:"w-full"},ul={__name:"WcSubs",setup(r){const u=q(),{wcSubsSettings:o}=j(u);return(l,e)=>(m(),v(W,null,{action:n(()=>[i(P,{onClick:e[2]||(e[2]=t=>c(u).updateWcSubsSettings())})]),default:n(()=>[a("div",al,[i(ol,{modelValue:c(o),"onUpdate:modelValue":e[0]||(e[0]=t=>M(o)?o.value=t:null)},null,8,["modelValue"])]),a("div",nl,[i(ll,{modelValue:c(o),"onUpdate:modelValue":e[1]||(e[1]=t=>M(o)?o.value=t:null)},null,8,["modelValue"])])]),_:1}))}},dl={__name:"Active",props:{modelValue:{type:Boolean,required:!0}},emits:["update:modelValue"],setup(r,{emit:u}){const o=r,l=$({get(){return o.modelValue},set(e){u("update:modelValue",e)}});return(e,t)=>(m(),v(b,null,{header:n(()=>[p(d(e.$t("saved_card")),1)]),default:n(()=>[i(O,{modelValue:l.value,"onUpdate:modelValue":t[0]||(t[0]=s=>l.value=s)},{subtitle:n(()=>[p(d(e.$t("saved_card_active")),1)]),default:n(()=>[p(d(e.$t("activate")),1)]),_:1},8,["modelValue"])]),_:1}))}},rl={class:"flex flex-col gap-3"},il={__name:"SaveStep",props:{modelValue:{type:String,required:!0}},emits:["update:modelValue"],setup(r,{emit:u}){const o=r,l=$({get(){return o.modelValue},set(e){u("update:modelValue",e)}});return(e,t)=>(m(),v(b,null,{header:n(()=>[p(d(e.$t("save_step")),1)]),default:n(()=>[a("div",rl,[i(w,{modelValue:l.value,"onUpdate:modelValue":t[0]||(t[0]=s=>l.value=s),value:"at_payment",name:"save_step"},{subtitle:n(()=>[p(d(e.$t("at_payment_desc")),1)]),default:n(()=>[p(d(e.$t("at_payment")),1)]),_:1},8,["modelValue"]),i(w,{modelValue:l.value,"onUpdate:modelValue":t[1]||(t[1]=s=>l.value=s),value:"after_payment",name:"save_step",disabled:""},{subtitle:n(()=>[p(d(e.$t("after_payment_desc")),1)]),default:n(()=>[p(d(e.$t("after_payment")),1),i(I)]),_:1},8,["modelValue"])])]),_:1}))}},ml={class:"flex justify-between w-full border-2 rounded-lg border-dashed border-gray-200 bg-gray-50 p-3"},pl=a("span",null," [gpos_user_saved_cards] ",-1),cl={key:1,class:"text-blue-600",textContent:"copied !"},_l={__name:"ShortCode",setup(r){let u=B(!0);const o=async l=>{await navigator.clipboard.writeText(l),u.value=!1,setTimeout(()=>{u.value=!0},1e3)};return(l,e)=>(m(),v(b,null,{header:n(()=>[p(d(l.$t("short_code")),1)]),footer:n(()=>[p(d(l.$t("save_card_short_code_desc")),1)]),default:n(()=>[a("div",ml,[pl,a("span",{class:"cursor-pointer",onClick:e[0]||(e[0]=t=>o("[gpos_user_saved_cards]"))},[c(u)?(m(),v(c(ue),{key:0,class:"w-4 h-4 text-blue-600"})):(m(),f("span",cl))])])]),_:1}))}},fl={class:"flex flex-col gap-3"},vl={__name:"CardName",props:{modelValue:{type:String,required:!0}},emits:["update:modelValue"],setup(r,{emit:u}){const o=r,l=$({get(){return o.modelValue},set(e){u("update:modelValue",e)}});return(e,t)=>(m(),v(b,null,{header:n(()=>[p(d(e.$t("card_name_field")),1)]),default:n(()=>[a("div",fl,[i(w,{modelValue:l.value,"onUpdate:modelValue":t[0]||(t[0]=s=>l.value=s),value:"use_default",name:"name_field"},{subtitle:n(()=>[p(d(e.$t("card_name_default_desc")),1)]),default:n(()=>[p(d(e.$t("card_name_default")),1)]),_:1},8,["modelValue"]),i(w,{modelValue:l.value,"onUpdate:modelValue":t[1]||(t[1]=s=>l.value=s),value:"show_field",name:"name_field"},{subtitle:n(()=>[p(d(e.$t("card_name_show_field_desc")),1)]),default:n(()=>[p(d(e.$t("card_name_show_field")),1)]),_:1},8,["modelValue"])])]),_:1}))}},gl={class:"w-full"},$l={class:"w-1/2"},bl={class:"w-1/2"},Vl={class:"w-1/2"},wl={__name:"CardSave",setup(r){const u=q(),{cardSave:o}=j(u);return(l,e)=>(m(),v(W,null,de({default:n(()=>[a("div",gl,[i(dl,{modelValue:c(o).active,"onUpdate:modelValue":e[0]||(e[0]=t=>c(o).active=t),onChange:e[1]||(e[1]=t=>c(u).updateCardSaveSettings())},null,8,["modelValue"])]),c(o).active?(m(),f(x,{key:0},[a("div",$l,[i(il,{modelValue:c(o).save_step,"onUpdate:modelValue":e[2]||(e[2]=t=>c(o).save_step=t)},null,8,["modelValue"])]),a("div",bl,[i(vl,{modelValue:c(o).name_field,"onUpdate:modelValue":e[3]||(e[3]=t=>c(o).name_field=t)},null,8,["modelValue"])]),a("div",Vl,[i(_l)])],64)):T("",!0)]),_:2},[c(o).active?{name:"action",fn:n(()=>[i(P,{onClick:e[4]||(e[4]=t=>c(u).updateCardSaveSettings())})]),key:"0"}:void 0]),1024))}},yl=["textContent"],hl=["textContent"],xl={__name:"WordPress",setup(r){const u=window.gpos.status.wordpress;return(o,l)=>(m(),v(b,null,{header:n(()=>[p(" WordPress ")]),default:n(()=>[(m(!0),f(x,null,k(c(u),(e,t)=>(m(),f("div",{key:t,class:N(`flex flex-row items-center justify-between p-2 ${t%2===0?"bg-gray-100":""}`)},[a("span",{textContent:d(e.label)},null,8,yl),a("span",{textContent:d(e.value)},null,8,hl)],2))),128))]),_:1}))}},Sl=["textContent"],Cl=["textContent"],Ul={__name:"Server",setup(r){const u=window.gpos.status.server;return(o,l)=>(m(),v(b,null,{header:n(()=>[p(" Server ")]),default:n(()=>[(m(!0),f(x,null,k(c(u),(e,t)=>(m(),f("div",{key:t,class:N(`flex flex-row items-center justify-between p-2 ${t%2===0?"bg-gray-100":""}`)},[a("span",{textContent:d(e.label)},null,8,Sl),a("span",{textContent:d(e.value)},null,8,Cl)],2))),128))]),_:1}))}},kl={class:"w-full"},ql={class:"w-full"},jl={__name:"Status",setup(r){const u=()=>{re(JSON.stringify(window.gpos.status),"status.json","text/json")};return(o,l)=>(m(),v(W,null,{action:n(()=>[i(z,{onClick:l[0]||(l[0]=e=>u())},{default:n(()=>[p(d(o.$t("export")),1)]),_:1})]),default:n(()=>[a("div",kl,[i(xl)]),a("div",ql,[i(Ul)])]),_:1}))}},Fl={},Al={class:"pl-8 py-1 text-[10px] font-[700] uppercase"};function Tl(r,u){return m(),f("div",Al,[U(r.$slots,"default")])}const Bl=E(Fl,[["render",Tl]]),Wl=["src"],J={__name:"NavElement",props:{active:{type:Boolean,default:!1},icon:{type:String,required:!0}},setup(r){const u=window.gpos.assets_url;return(o,l)=>(m(),f("div",{class:N(`py-4 pl-8 border-l-4 cursor-pointer flex items-center font-medium text-sm
   ${r.active?" bg-white border-blue-800":"border-[#FAFAFA] bg-[#FAFAFA]"} `)},[a("img",{class:"w-5 h-5 mr-3 text-blue-600",src:`${c(u)}/images/settings/${r.icon}.svg`,alt:""},null,8,Wl),a("div",{class:N(`${r.active?"text-black":"text-[#6E778A]"} flex gap-2 items-center`)},[U(o.$slots,"default")],2)],2))}},Dl={class:"w-full flex"},Nl={class:"w-1/5 flex flex-col bg-[#FAFAFA] py-8 rounded-l-lg space-y-8"},Ol={key:0,href:"https://yardim.gurmehub.com/docs/pos-entegrator/?utm_source=wp_plugin&utm_medium=referal&utm_campaign=documents",target:"_blank"},Pl={class:"w-4/5 flex flex-col bg-white rounded-r-lg p-8"},El={__name:"App",setup(r){const u=window.gpos.integrations,o=window.gpos.is_pro_active,l=F(L),e=B([{sectionTitle:"general_settings",sections:[{title:"form_settings",icon:"queue-list-icon",component:F(L),active:!0}]},{sectionTitle:"integration_settings",sections:[{title:"woocommerce",component:F(Qt)},{title:"givewp",component:F(tl)},{title:"woocommerce_subs",component:F(ul)}]},{sectionTitle:"payment_settings",sections:[{title:"card_save",component:F(wl),needPro:!0}]},{sectionTitle:"other",sections:[{title:"status",component:F(jl)}]}]);e.value[1].sections=e.value[1].sections.filter(s=>u[s.title]?u[s.title]:!1);const t=s=>{e.value.forEach(_=>{_.sections.forEach(g=>{g.active=g.title===s,g.title===s&&(l.value=g.component)})})};return(s,_)=>(m(),v(_e,{text:s.$t("settings"),href:"https://yardim.gurmehub.com/docs/pos-entegrator/?utm_source=wp_plugin&utm_medium=referal&utm_campaign=footer"},{default:n(()=>[a("div",Dl,[a("div",Nl,[(m(!0),f(x,null,k(e.value,g=>(m(),f("div",{key:g.sectionTitle},[i(Bl,null,{default:n(()=>[p(d(s.$t(g.sectionTitle)),1)]),_:2},1024),(m(!0),f(x,null,k(g.sections,(S,h)=>(m(),v(J,{key:h,icon:S.title,active:S.active,onClick:V=>S.needPro&&c(o)||!S.needPro?t(S.title):!1},{default:n(()=>[p(d(s.$t(S.title))+" ",1),S.needPro?(m(),v(K,{key:0})):T("",!0)]),_:2},1032,["icon","active","onClick"]))),128)),g.sectionTitle==="other"?(m(),f("a",Ol,[i(J,{icon:"documents",active:!1},{default:n(()=>[p(d(s.$t("documents")),1)]),_:1})])):T("",!0)]))),128))]),a("div",Pl,[(m(),v(ie(l.value)))])])]),_:1},8,["text"]))}},Ml=me({locale:"default",messages:window.gpos.strings,legacy:!1}),G=pe(El);G.use(ce);G.use(Ml);G.mount("#app");
