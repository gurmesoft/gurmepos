import{i as e}from"../vendor/main.js";import{a as t}from"../tailwind/main.js";const o=e("Checkout",{state:()=>({card:{bin:"",expiry_month:"",expiry_year:"",cvv:"",type:"",brand:"",family:"",bank_name:"",country:""},selectedSavedCard:"",requestedBin:"",userId:window.gpos.user_id||!1,isProActive:window.gpos.is_pro_active||!1,isTestMode:window.gpos.is_test_mode||!1,isInstallmentsActive:window.gpos.is_installments_active||!1,assetsUrl:window.gpos.asset_dir_url||"/",installments:window.gpos.installments||[],savedCards:window.gpos.saved_cards||[],formSettings:window.gpos.form_settings||{},cardSaveSettings:window.gpos.card_save_settings||{},gateway:window.gpos.gateway||!1}),actions:{checkBin(s){return t.post("check_bin",{bin:s})}}});export{o as u};
