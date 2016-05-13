<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PermissionTableSeeder extends Seeder
{

    public function run()
    {

        if (env('DB_DRIVER') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        if (env('DB_DRIVER') == 'mysql') {
            DB::table(config('access.permissions_table'))->truncate();
            DB::table(config('access.permission_role_table'))->truncate();
            DB::table(config('access.permission_user_table'))->truncate();
        } elseif (env('DB_DRIVER') == 'sqlite') {
            DB::statement("DELETE FROM ".config('access.permissions_table'));
            DB::statement("DELETE FROM ".config('access.permission_role_table'));
            DB::statement("DELETE FROM ".config('access.permission_user_table'));
        } else { //For PostgreSQL or anything else
            DB::statement("TRUNCATE TABLE ".config('access.permissions_table')." CASCADE");
            DB::statement("TRUNCATE TABLE ".config('access.permission_role_table')." CASCADE");
            DB::statement("TRUNCATE TABLE ".config('access.permission_user_table')." CASCADE");
        }

        //Don't need to assign any permissions to administrator because the all flag is set to true

        /**
         * Misc Access Permissions
         */
        $permission_model = config('access.permission');
        $viewBackend = new $permission_model;
        $viewBackend->name = 'view-backend';
        $viewBackend->display_name = 'View Backend';
        $viewBackend->system = true;
        $viewBackend->group_id = 1;
        $viewBackend->sort = 1;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewAccessManagement = new $permission_model;
        $viewAccessManagement->name = 'view-access-management';
        $viewAccessManagement->display_name = 'View Access Management';
        $viewAccessManagement->system = true;
        $viewAccessManagement->group_id = 1;
        $viewAccessManagement->sort = 2;
        $viewAccessManagement->created_at = Carbon::now();
        $viewAccessManagement->updated_at = Carbon::now();
        $viewAccessManagement->save();

        /**
         * Access Permissions
         */

        /**
         * User
         */
        $permission_model = config('access.permission');
        $createUsers = new $permission_model;
        $createUsers->name = 'create-users';
        $createUsers->display_name = 'Create Users';
        $createUsers->system = true;
        $createUsers->group_id = 2;
        $createUsers->sort = 5;
        $createUsers->created_at = Carbon::now();
        $createUsers->updated_at = Carbon::now();
        $createUsers->save();

        $permission_model = config('access.permission');
        $editUsers = new $permission_model;
        $editUsers->name = 'edit-users';
        $editUsers->display_name = 'Edit Users';
        $editUsers->system = true;
        $editUsers->group_id = 2;
        $editUsers->sort = 6;
        $editUsers->created_at = Carbon::now();
        $editUsers->updated_at = Carbon::now();
        $editUsers->save();

        $permission_model = config('access.permission');
        $deleteUsers = new $permission_model;
        $deleteUsers->name = 'delete-users';
        $deleteUsers->display_name = 'Delete Users';
        $deleteUsers->system = true;
        $deleteUsers->group_id = 2;
        $deleteUsers->sort = 7;
        $deleteUsers->created_at = Carbon::now();
        $deleteUsers->updated_at = Carbon::now();
        $deleteUsers->save();

        $permission_model = config('access.permission');
        $changeUserPassword = new $permission_model;
        $changeUserPassword->name = 'change-user-password';
        $changeUserPassword->display_name = 'Change User Password';
        $changeUserPassword->system = true;
        $changeUserPassword->group_id = 2;
        $changeUserPassword->sort = 8;
        $changeUserPassword->created_at = Carbon::now();
        $changeUserPassword->updated_at = Carbon::now();
        $changeUserPassword->save();

        $permission_model = config('access.permission');
        $deactivateUser = new $permission_model;
        $deactivateUser->name = 'deactivate-users';
        $deactivateUser->display_name = 'Deactivate Users';
        $deactivateUser->system = true;
        $deactivateUser->group_id = 2;
        $deactivateUser->sort = 9;
        $deactivateUser->created_at = Carbon::now();
        $deactivateUser->updated_at = Carbon::now();
        $deactivateUser->save();

        $permission_model = config('access.permission');
        $banUsers = new $permission_model;
        $banUsers->name = 'ban-users';
        $banUsers->display_name = 'Ban Users';
        $banUsers->system = true;
        $banUsers->group_id = 2;
        $banUsers->sort = 10;
        $banUsers->created_at = Carbon::now();
        $banUsers->updated_at = Carbon::now();
        $banUsers->save();

        $permission_model = config('access.permission');
        $reactivateUser = new $permission_model;
        $reactivateUser->name = 'reactivate-users';
        $reactivateUser->display_name = 'Re-Activate Users';
        $reactivateUser->system = true;
        $reactivateUser->group_id = 2;
        $reactivateUser->sort = 11;
        $reactivateUser->created_at = Carbon::now();
        $reactivateUser->updated_at = Carbon::now();
        $reactivateUser->save();

        $permission_model = config('access.permission');
        $unbanUser = new $permission_model;
        $unbanUser->name = 'unban-users';
        $unbanUser->display_name = 'Un-Ban Users';
        $unbanUser->system = true;
        $unbanUser->group_id = 2;
        $unbanUser->sort = 12;
        $unbanUser->created_at = Carbon::now();
        $unbanUser->updated_at = Carbon::now();
        $unbanUser->save();

        $permission_model = config('access.permission');
        $undeleteUser = new $permission_model;
        $undeleteUser->name = 'undelete-users';
        $undeleteUser->display_name = 'Restore Users';
        $undeleteUser->system = true;
        $undeleteUser->group_id = 2;
        $undeleteUser->sort = 13;
        $undeleteUser->created_at = Carbon::now();
        $undeleteUser->updated_at = Carbon::now();
        $undeleteUser->save();

        $permission_model = config('access.permission');
        $permanentlyDeleteUser = new $permission_model;
        $permanentlyDeleteUser->name = 'permanently-delete-users';
        $permanentlyDeleteUser->display_name = 'Permanently Delete Users';
        $permanentlyDeleteUser->system = true;
        $permanentlyDeleteUser->group_id = 2;
        $permanentlyDeleteUser->sort = 14;
        $permanentlyDeleteUser->created_at = Carbon::now();
        $permanentlyDeleteUser->updated_at = Carbon::now();
        $permanentlyDeleteUser->save();

        $permission_model = config('access.permission');
        $resendConfirmationEmail = new $permission_model;
        $resendConfirmationEmail->name = 'resend-user-confirmation-email';
        $resendConfirmationEmail->display_name = 'Resend Confirmation E-mail';
        $resendConfirmationEmail->system = true;
        $resendConfirmationEmail->group_id = 2;
        $resendConfirmationEmail->sort = 15;
        $resendConfirmationEmail->created_at = Carbon::now();
        $resendConfirmationEmail->updated_at = Carbon::now();
        $resendConfirmationEmail->save();

        /**
         * Role
         */
        $permission_model = config('access.permission');
        $createRoles = new $permission_model;
        $createRoles->name = 'create-roles';
        $createRoles->display_name = 'Create Roles';
        $createRoles->system = true;
        $createRoles->group_id = 3;
        $createRoles->sort = 2;
        $createRoles->created_at = Carbon::now();
        $createRoles->updated_at = Carbon::now();
        $createRoles->save();

        $permission_model = config('access.permission');
        $editRoles = new $permission_model;
        $editRoles->name = 'edit-roles';
        $editRoles->display_name = 'Edit Roles';
        $editRoles->system = true;
        $editRoles->group_id = 3;
        $editRoles->sort = 3;
        $editRoles->created_at = Carbon::now();
        $editRoles->updated_at = Carbon::now();
        $editRoles->save();

        $permission_model = config('access.permission');
        $deleteRoles = new $permission_model;
        $deleteRoles->name = 'delete-roles';
        $deleteRoles->display_name = 'Delete Roles';
        $deleteRoles->system = true;
        $deleteRoles->group_id = 3;
        $deleteRoles->sort = 4;
        $deleteRoles->created_at = Carbon::now();
        $deleteRoles->updated_at = Carbon::now();
        $deleteRoles->save();

        /**
         * Permission Group
         */
        $permission_model = config('access.permission');
        $createPermissionGroups = new $permission_model;
        $createPermissionGroups->name = 'create-permission-groups';
        $createPermissionGroups->display_name = 'Create Permission Groups';
        $createPermissionGroups->system = true;
        $createPermissionGroups->group_id = 4;
        $createPermissionGroups->sort = 1;
        $createPermissionGroups->created_at = Carbon::now();
        $createPermissionGroups->updated_at = Carbon::now();
        $createPermissionGroups->save();

        $permission_model = config('access.permission');
        $editPermissionGroups = new $permission_model;
        $editPermissionGroups->name = 'edit-permission-groups';
        $editPermissionGroups->display_name = 'Edit Permission Groups';
        $editPermissionGroups->system = true;
        $editPermissionGroups->group_id = 4;
        $editPermissionGroups->sort = 2;
        $editPermissionGroups->created_at = Carbon::now();
        $editPermissionGroups->updated_at = Carbon::now();
        $editPermissionGroups->save();

        $permission_model = config('access.permission');
        $deletePermissionGroups = new $permission_model;
        $deletePermissionGroups->name = 'delete-permission-groups';
        $deletePermissionGroups->display_name = 'Delete Permission Groups';
        $deletePermissionGroups->system = true;
        $deletePermissionGroups->group_id = 4;
        $deletePermissionGroups->sort = 3;
        $deletePermissionGroups->created_at = Carbon::now();
        $deletePermissionGroups->updated_at = Carbon::now();
        $deletePermissionGroups->save();

        $permission_model = config('access.permission');
        $sortPermissionGroups = new $permission_model;
        $sortPermissionGroups->name = 'sort-permission-groups';
        $sortPermissionGroups->display_name = 'Sort Permission Groups';
        $sortPermissionGroups->system = true;
        $sortPermissionGroups->group_id = 4;
        $sortPermissionGroups->sort = 4;
        $sortPermissionGroups->created_at = Carbon::now();
        $sortPermissionGroups->updated_at = Carbon::now();
        $sortPermissionGroups->save();

        /**
         * Permission
         */
        $permission_model = config('access.permission');
        $createPermissions = new $permission_model;
        $createPermissions->name = 'create-permissions';
        $createPermissions->display_name = 'Create Permissions';
        $createPermissions->system = true;
        $createPermissions->group_id = 4;
        $createPermissions->sort = 5;
        $createPermissions->created_at = Carbon::now();
        $createPermissions->updated_at = Carbon::now();
        $createPermissions->save();

        $permission_model = config('access.permission');
        $editPermissions = new $permission_model;
        $editPermissions->name = 'edit-permissions';
        $editPermissions->display_name = 'Edit Permissions';
        $editPermissions->system = true;
        $editPermissions->group_id = 4;
        $editPermissions->sort = 6;
        $editPermissions->created_at = Carbon::now();
        $editPermissions->updated_at = Carbon::now();
        $editPermissions->save();

        $permission_model = config('access.permission');
        $deletePermissions = new $permission_model;
        $deletePermissions->name = 'delete-permissions';
        $deletePermissions->display_name = 'Delete Permissions';
        $deletePermissions->system = true;
        $deletePermissions->group_id = 4;
        $deletePermissions->sort = 7;
        $deletePermissions->created_at = Carbon::now();
        $deletePermissions->updated_at = Carbon::now();
        $deletePermissions->save();

        /**
         * Feature
         */
        $permission_model = config('access.permission');
        $createPlaces = new $permission_model;
        $createPlaces->name = 'manage-features';
        $createPlaces->display_name = 'Manage Features';
        $createPlaces->system = true;
        $createPlaces->group_id = 5;
        $createPlaces->sort = 5;
        $createPlaces->created_at = Carbon::now();
        $createPlaces->updated_at = Carbon::now();
        $createPlaces->save();

        $permission_model = config('access.permission');
        $createPlaces = new $permission_model;
        $createPlaces->name = 'view-features';
        $createPlaces->display_name = 'View Features';
        $createPlaces->system = true;
        $createPlaces->group_id = 5;
        $createPlaces->sort = 5;
        $createPlaces->created_at = Carbon::now();
        $createPlaces->updated_at = Carbon::now();
        $createPlaces->save();

        /**
         * Places
         */
        $permission_model = config('access.permission');
        $createPlaces = new $permission_model;
        $createPlaces->name = 'create-places';
        $createPlaces->display_name = 'Create Place';
        $createPlaces->system = true;
        $createPlaces->group_id = 6;
        $createPlaces->sort = 5;
        $createPlaces->created_at = Carbon::now();
        $createPlaces->updated_at = Carbon::now();
        $createPlaces->save();

        $permission_model = config('access.permission');
        $editPlaces = new $permission_model;
        $editPlaces->name = 'edit-places';
        $editPlaces->display_name = 'Edit Place';
        $editPlaces->system = true;
        $editPlaces->group_id = 6;
        $editPlaces->sort = 6;
        $editPlaces->created_at = Carbon::now();
        $editPlaces->updated_at = Carbon::now();
        $editPlaces->save();

        $permission_model = config('access.permission');
        $deletePlaces = new $permission_model;
        $deletePlaces->name = 'delete-places';
        $deletePlaces->display_name = 'Delete Place';
        $deletePlaces->system = true;
        $deletePlaces->group_id = 6;
        $deletePlaces->sort = 7;
        $deletePlaces->created_at = Carbon::now();
        $deletePlaces->updated_at = Carbon::now();
        $deletePlaces->save();


        /**
         * Addresses
         */
        $permission_model = config('access.permission');
        $createAddresses = new $permission_model;
        $createAddresses->name = 'create-addresses';
        $createAddresses->display_name = 'Create Address';
        $createAddresses->system = true;
        $createAddresses->group_id = 6;
        $createAddresses->sort = 5;
        $createAddresses->created_at = Carbon::now();
        $createAddresses->updated_at = Carbon::now();
        $createAddresses->save();

        $permission_model = config('access.permission');
        $editAddresses = new $permission_model;
        $editAddresses->name = 'edit-addresses';
        $editAddresses->display_name = 'Edit Address';
        $editAddresses->system = true;
        $editAddresses->group_id = 6;
        $editAddresses->sort = 6;
        $editAddresses->created_at = Carbon::now();
        $editAddresses->updated_at = Carbon::now();
        $editAddresses->save();

        $permission_model = config('access.permission');
        $deleteAddresses = new $permission_model;
        $deleteAddresses->name = 'delete-addresses';
        $deleteAddresses->display_name = 'Delete Address';
        $deleteAddresses->system = true;
        $deleteAddresses->group_id = 6;
        $deleteAddresses->sort = 7;
        $deleteAddresses->created_at = Carbon::now();
        $deleteAddresses->updated_at = Carbon::now();
        $deleteAddresses->save();


        /**
         * Districts
         */
        $permission_model = config('access.permission');
        $createDistricts = new $permission_model;
        $createDistricts->name = 'create-districts';
        $createDistricts->display_name = 'Create District';
        $createDistricts->system = true;
        $createDistricts->group_id = 6;
        $createDistricts->sort = 5;
        $createDistricts->created_at = Carbon::now();
        $createDistricts->updated_at = Carbon::now();
        $createDistricts->save();

        $permission_model = config('access.permission');
        $editDistricts = new $permission_model;
        $editDistricts->name = 'edit-districts';
        $editDistricts->display_name = 'Edit District';
        $editDistricts->system = true;
        $editDistricts->group_id = 6;
        $editDistricts->sort = 6;
        $editDistricts->created_at = Carbon::now();
        $editDistricts->updated_at = Carbon::now();
        $editDistricts->save();

        $permission_model = config('access.permission');
        $deleteDistricts = new $permission_model;
        $deleteDistricts->name = 'delete-districts';
        $deleteDistricts->display_name = 'Delete District';
        $deleteDistricts->system = true;
        $deleteDistricts->group_id = 6;
        $deleteDistricts->sort = 7;
        $deleteDistricts->created_at = Carbon::now();
        $deleteDistricts->updated_at = Carbon::now();
        $deleteDistricts->save();


        /**
         * Cities
         */
        $permission_model = config('access.permission');
        $createCities = new $permission_model;
        $createCities->name = 'create-cities';
        $createCities->display_name = 'Create City';
        $createCities->system = true;
        $createCities->group_id = 6;
        $createCities->sort = 5;
        $createCities->created_at = Carbon::now();
        $createCities->updated_at = Carbon::now();
        $createCities->save();

        $permission_model = config('access.permission');
        $editCities = new $permission_model;
        $editCities->name = 'edit-cities';
        $editCities->display_name = 'Edit City';
        $editCities->system = true;
        $editCities->group_id = 6;
        $editCities->sort = 6;
        $editCities->created_at = Carbon::now();
        $editCities->updated_at = Carbon::now();
        $editCities->save();

        $permission_model = config('access.permission');
        $deleteCities = new $permission_model;
        $deleteCities->name = 'delete-cities';
        $deleteCities->display_name = 'Delete City';
        $deleteCities->system = true;
        $deleteCities->group_id = 6;
        $deleteCities->sort = 7;
        $deleteCities->created_at = Carbon::now();
        $deleteCities->updated_at = Carbon::now();
        $deleteCities->save();


        /**
         * Provinces
         */
        $permission_model = config('access.permission');
        $createProvinces = new $permission_model;
        $createProvinces->name = 'create-provinces';
        $createProvinces->display_name = 'Create Province';
        $createProvinces->system = true;
        $createProvinces->group_id = 6;
        $createProvinces->sort = 5;
        $createProvinces->created_at = Carbon::now();
        $createProvinces->updated_at = Carbon::now();
        $createProvinces->save();

        $permission_model = config('access.permission');
        $editProvinces = new $permission_model;
        $editProvinces->name = 'edit-provinces';
        $editProvinces->display_name = 'Edit Province';
        $editProvinces->system = true;
        $editProvinces->group_id = 6;
        $editProvinces->sort = 6;
        $editProvinces->created_at = Carbon::now();
        $editProvinces->updated_at = Carbon::now();
        $editProvinces->save();

        $permission_model = config('access.permission');
        $deleteProvinces = new $permission_model;
        $deleteProvinces->name = 'delete-provinces';
        $deleteProvinces->display_name = 'Delete Province';
        $deleteProvinces->system = true;
        $deleteProvinces->group_id = 6;
        $deleteProvinces->sort = 7;
        $deleteProvinces->created_at = Carbon::now();
        $deleteProvinces->updated_at = Carbon::now();
        $deleteProvinces->save();


        /**
         * Countries
         */
        $permission_model = config('access.permission');
        $createCountries = new $permission_model;
        $createCountries->name = 'create-countries';
        $createCountries->display_name = 'Create Country';
        $createCountries->system = true;
        $createCountries->group_id = 6;
        $createCountries->sort = 5;
        $createCountries->created_at = Carbon::now();
        $createCountries->updated_at = Carbon::now();
        $createCountries->save();

        $permission_model = config('access.permission');
        $editCountries = new $permission_model;
        $editCountries->name = 'edit-countries';
        $editCountries->display_name = 'Edit Country';
        $editCountries->system = true;
        $editCountries->group_id = 6;
        $editCountries->sort = 6;
        $editCountries->created_at = Carbon::now();
        $editCountries->updated_at = Carbon::now();
        $editCountries->save();

        $permission_model = config('access.permission');
        $deleteCountries = new $permission_model;
        $deleteCountries->name = 'delete-countries';
        $deleteCountries->display_name = 'Delete Country';
        $deleteCountries->system = true;
        $deleteCountries->group_id = 6;
        $deleteCountries->sort = 7;
        $deleteCountries->created_at = Carbon::now();
        $deleteCountries->updated_at = Carbon::now();
        $deleteCountries->save();


        /**
         * Persons
         */
        $permission_model = config('access.permission');
        $createPeople = new $permission_model;
        $createPeople->name = 'create-people';
        $createPeople->display_name = 'Create Person';
        $createPeople->system = true;
        $createPeople->group_id = 7;
        $createPeople->sort = 5;
        $createPeople->created_at = Carbon::now();
        $createPeople->updated_at = Carbon::now();
        $createPeople->save();

        $permission_model = config('access.permission');
        $editPeople = new $permission_model;
        $editPeople->name = 'edit-people';
        $editPeople->display_name = 'Edit Person';
        $editPeople->system = true;
        $editPeople->group_id = 7;
        $editPeople->sort = 6;
        $editPeople->created_at = Carbon::now();
        $editPeople->updated_at = Carbon::now();
        $editPeople->save();

        $permission_model = config('access.permission');
        $deletePeople = new $permission_model;
        $deletePeople->name = 'delete-people';
        $deletePeople->display_name = 'Delete Person';
        $deletePeople->system = true;
        $deletePeople->group_id = 7;
        $deletePeople->sort = 7;
        $deletePeople->created_at = Carbon::now();
        $deletePeople->updated_at = Carbon::now();
        $deletePeople->save();


        /**
         * Institutions
         */
        $permission_model = config('access.permission');
        $createInstitutions = new $permission_model;
        $createInstitutions->name = 'create-institutions';
        $createInstitutions->display_name = 'Create Institution';
        $createInstitutions->system = true;
        $createInstitutions->group_id = 7;
        $createInstitutions->sort = 5;
        $createInstitutions->created_at = Carbon::now();
        $createInstitutions->updated_at = Carbon::now();
        $createInstitutions->save();

        $permission_model = config('access.permission');
        $editInstitutions = new $permission_model;
        $editInstitutions->name = 'edit-institutions';
        $editInstitutions->display_name = 'Edit Institution';
        $editInstitutions->system = true;
        $editInstitutions->group_id = 7;
        $editInstitutions->sort = 6;
        $editInstitutions->created_at = Carbon::now();
        $editInstitutions->updated_at = Carbon::now();
        $editInstitutions->save();

        $permission_model = config('access.permission');
        $deleteInstitutions = new $permission_model;
        $deleteInstitutions->name = 'delete-institutions';
        $deleteInstitutions->display_name = 'Delete Institution';
        $deleteInstitutions->system = true;
        $deleteInstitutions->group_id = 7;
        $deleteInstitutions->sort = 7;
        $deleteInstitutions->created_at = Carbon::now();
        $deleteInstitutions->updated_at = Carbon::now();
        $deleteInstitutions->save();


        /**
         * Contacts
         */
        $permission_model = config('access.permission');
        $createContacts = new $permission_model;
        $createContacts->name = 'create-contacts';
        $createContacts->display_name = 'Create Contact';
        $createContacts->system = true;
        $createContacts->group_id = 7;
        $createContacts->sort = 5;
        $createContacts->created_at = Carbon::now();
        $createContacts->updated_at = Carbon::now();
        $createContacts->save();

        $permission_model = config('access.permission');
        $editContacts = new $permission_model;
        $editContacts->name = 'edit-contacts';
        $editContacts->display_name = 'Edit Contact';
        $editContacts->system = true;
        $editContacts->group_id = 7;
        $editContacts->sort = 6;
        $editContacts->created_at = Carbon::now();
        $editContacts->updated_at = Carbon::now();
        $editContacts->save();

        $permission_model = config('access.permission');
        $deleteContacts = new $permission_model;
        $deleteContacts->name = 'delete-contacts';
        $deleteContacts->display_name = 'Delete Contact';
        $deleteContacts->system = true;
        $deleteContacts->group_id = 7;
        $deleteContacts->sort = 7;
        $deleteContacts->created_at = Carbon::now();
        $deleteContacts->updated_at = Carbon::now();
        $deleteContacts->save();

        if (env('DB_DRIVER') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
