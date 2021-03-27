<?php
namespace App;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
class Contact extends Model
{
    use HasApiTokens, Authenticatable, Authorizable;

    use HasRoles;
    /* rest of the model */

    public function contactAddress() {
     return $this->hasMany('App\Address');
    }

      /*
       @WHY =>validation on user fields
       @WHEN  => 3 dec 2018
       @WHO => Gurpreet kaur
      */

       private $contacts = array(
         'salutation_id'=>'required',
         'category_id'=>'required',
         'title_id'=>'required',
         'contact_name'=>'required',
         'company_name'=>'required',
         'contact_phone'=>'required',
         'contact_email'=>'required|email|max:255|min:3|unique:contacts,email',
         'contact_address1'=>'required',
         'contact_type'=>'required', // means commerical or residencial
         'contact_city'=>'required',
         'contact_zip_code'=>'required',
         'contact_country_id'=>'required',
         'contact_state_id'=>'required',
         'contact_fax'=>'required',
         'default_billing_address'=>'required',
         'default_shipping_address'=>'required',
         'primary_speciality_id'=>'required',
         'website'=>'required',
         'lead_status_id'=>'required',
         'lead_source'=>'required',
         'willingtostock'=>'required',
          // .. more rules here ..
        );

       public function validateAddContacts($data)  {
            // make a new validator object
              $helper = new Helpers();
              $custommessage= $helper->ErrorMessages();
              $data= $helper->ValidationExceptionError($data, $this->contacts,$custommessage);
              return $data;
        }

 // Update the contacts

        private $updatecontacts = array(
          'saluation'=>'required',
          'category'=>'required',
          'title'=>'required',
          'contact_name'=>'required',
          'company_name'=>'required',
          'phone'=>'required',
          'email'=>'required',
          'address1'=>'required',
          'type'=>'required', // means commerical or residencial
          'city'=>'required',
          'zip'=>'required',
          'country_id'=>'required',
          'state_id'=>'required',
          'fax'=>'required',
          'type'=>'required',
          'default_billing_address'=>'required',
          'primary_speciality_id'=>'required',
          'website'=>'required',
          'lead_status'=>'required',
          'lead_source'=>'required',
          'willingtostock'=>'required',
          'id'=>'required'
           //..more rules here ..
         );

         public function validateUpdateContacts($data)  {
              //make a new validator object
               $helper = new Helpers();
               $custommessage= $helper->ErrorMessages();
               $data= $helper->ValidationExceptionError($data, $this->updatecontacts,$custommessage);
               return $data;
         }

            // use the contact controller(contact list function)
         public function contactcategory() {
          return $this->belongsTo('App\Category','category_id','id');
         }

  // use the contact controller(contact list function)
         public function contacttitle() {
          return $this->belongsTo('App\Category','contact_title_id','id');
         }

      // use the contact controller(contact list function)
        public function contactSpeciality() {
         return $this->belongsTo('App\Speciality','primary_speciality_id','id');
        }

        // use the contact controller(contact list function)// match the primary data
          public function contactSecondaySpeciality() {
           return $this->belongsTo('App\Speciality','secondary_speciality_id','id');
          }

      // use the contact controller(contact list function)// match the primary data
        public function ContactLeadStatus() {
         return $this->belongsTo('App\LeadStatus','lead_status_id','id');
        }


        public function contactsalutation() {
          return $this->belongsTo('App\Salutation','salutation_id','id');
        }
        //
        public function contactregion() {
          return $this->belongsTo('App\Country','country_id','id');
        }

        public function contactmanagers() {
          return $this->belongsTo('App\User','created_by','id');
        }

}
