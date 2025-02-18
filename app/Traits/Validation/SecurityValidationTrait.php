<?php

namespace App\Traits\Validation;

use Mews\Purifier\Facades\Purifier;
use App\Models\PlanType;

trait SecurityValidationTrait 
{
    /**
     * Sanitize and validate input against SQL injection and other malicious attempts
     * 
     * @param mixed $input Raw input to validate
     * @param string $type Type of validation (month, year, citizenship, etc.)
     * @return mixed Sanitized and validated input
     */
    public function secureValidate($input, string $type = 'default')
    {


        if (is_array($input)) {
            return $input;
        }
        if(!is_array($input)){
            
            // First, strip any potential HTML and clean with Purifier
            $sanitized =strip_tags(Purifier::clean($input));

            // Remove potential SQL injection characters
            $sanitized = $this->removeSQLInjectionRisks($sanitized);

        }

    
        // Validate based on type
        switch ($type) {
            case 'month':
                return $this->validateMonth($sanitized);
            case 'day':
               return $this->validateDay($sanitized);
            case 'year':
                return $this->validateYear($sanitized);
            case 'citizenship':
                return $this->validateCitizenship($sanitized);
            case 'amount':
                return $this->validateAmount($sanitized);
            case 'passengers':
                return $this->validatePassengers($sanitized);
            case 'bank':
                return $this->validateBank($sanitized);
            case 'mortgaged':
                return $this->validateMortgaged($sanitized);
            case 'members_emailaddress':
                return $this->validateEmail($sanitized);
            case 'option':
                return $this->validateOption($sanitized);
            case 'members_civilstatus':
                return $this->validateCivilStatus($sanitized);
           case 'mailing_preference':
                    return $this->validateMailingPreference($sanitized);
            case 'zipcode':
                return $this->validatePhilippinesZipCode($sanitized);
            case 'plan_type':
                return $this->validatePlanName($sanitized);
            case 'vehicle_fuel':
                return $this->validateFuelType($sanitized);
            case 'gender':
                return $this->validateGender($sanitized);
            case 'licenseExpirationDate':
                return $this->validateLicenseExpirationDate($sanitized);
            case 'dlcode':
                return $this->validateDLCode($input);
            case 'restriction':
                return $this->validateLicenseRestrictions($input);
            case 'pidp_plantype':
                return $this->validatePIDPPlanTypeDetails($sanitized);
            case 'round_depart_return':
                return $this->validateDateRange($sanitized);
            case 'oneway_depart':
                return $this->validateSingleDate($sanitized);
            case 'boolean':
                    return $this->validateBoolean($sanitized);
            case 'integer':
                return $this->validateInteger($sanitized);

            default:
                return $this->generalSanitize($sanitized);
        }
    }



    /**
     * Remove potential SQL injection risks
     * 
     * @param string $input Input to sanitize
     * @return string Sanitized input
     */
    private function removeSQLInjectionRisks(string $input): string
    {
        // Comprehensive SQL injection removal
        $sanitized = $input;
    
        // Remove comments
        $sanitized = preg_replace('/--.*/', '', $sanitized);
        
        // Remove specific injection patterns

        $dangerousPatterns = [
            '/(\s*OR\s*\'?\d+\'?\s*=\s*\'?\d+\'?)/i',        // Matches OR '1'='1'
            '/(\s*AND\s*\'?\d+\'?\s*=\s*\'?\d+\'?)/i',       // Matches AND '1'='1'
            '/\b(SELECT|INSERT|UPDATE|DELETE|DROP|UNION|ALTER)\b/i',  // Blocks SQL keywords
            '/[\';#]/',          // Removes dangerous characters
            '/\-\-/',            // Removes SQL comments
            '/\b(OR|AND)\b/i',   // Removes logical operators
        ];
    
        // Iteratively remove dangerous patterns
        foreach ($dangerousPatterns as $pattern) {
            $sanitized = preg_replace($pattern, '', $sanitized);
        }
    
        // Additional sanitization
        $sanitized = strip_tags($sanitized);
        $sanitized =htmlspecialchars($sanitized, ENT_QUOTES, 'UTF-8');
    
        return trim($sanitized);
    }

    /**
     * General sanitization for inputs
     * 
     * @param mixed $input Input to sanitize
     * @return mixed Sanitized input
     */
    private function generalSanitize($input)
    {
        return $input;
    }

    /**
     * Validate month input
     * 
     * @param mixed $input Month input
     * @return string Validated two-digit month
     */
    private function validateMonth($input): string
    {
        $allowed_months = [
            '01' => 'January', '02' => 'February', '03' => 'March',
            '04' => 'April', '05' => 'May', '06' => 'June',
            '07' => 'July', '08' => 'August', '09' => 'September',
            '10' => 'October', '11' => 'November', '12' => 'December'
        ];
        
        // If numeric, pad with zero
        if (is_numeric($input)) {
            $month = str_pad((int)$input, 2, '0', STR_PAD_LEFT);
        } else {
            // Convert month name to numeric
            $month = array_search(ucfirst(strtolower($input)), 
                array_map('ucfirst', array_map('strtolower', $allowed_months)));
            $month = $month ? str_pad($month, 2, '0', STR_PAD_LEFT) : '01';
        }

        // Validate month is in allowed list
        return isset($allowed_months[$month]) ? $month : '01';
    }

    /**
     * Validate year input
     * 
     * @param mixed $input Year input
     * @return int Validated year
     */
    private function validateYear($input): int
    {
        return filter_var($input, FILTER_VALIDATE_INT, [
            'options' => [
                'min_range' => 1900, 
                'max_range' => date('Y'), 
                'default' => date('Y')
            ]
        ]);
    }


    /**
     * Validate year input
     * 
     * @param mixed $input Year input
     * @return int Validated year
     */
    private function validateDay($input): int
    {
        return filter_var($input, FILTER_VALIDATE_INT, 
        [
            'options' => [
                'min_range' => 1,
                'max_range' => 31,
                'default' => 1
            ]
        
        ]);
    }
  

    /**
     * Validate citizenship input
     * 
     * @param string $input Citizenship input
     * @return string Sanitized citizenship
     */
    private function validateCitizenship(string $input): string
    {
  
        if ($input === 'filipino' || $input === 'foreigner') {
            return $input;
        }

        // Default to 'filipino' if input is invalid
        return 'filipino';
    }

    /**
     * Validate amount input
     * 
     * @param mixed $input Amount input
     * @return int Validated amount
     */
    private function validateAmount($input): int
    {
        return filter_var($input, FILTER_VALIDATE_FLOAT, [
            'options' => [
                'min_range' => 0,  // Ensure non-negative
                'default' => 0     // Fallback to 0 if invalid
            ]
        ]);
    }

    /**
     * Validate number of passengers
     * 
     * @param mixed $input Passengers input
     * @return int Validated passenger count
     */
    private function validatePassengers($input): int
    {
        return filter_var($input, FILTER_VALIDATE_INT, [
            'options' => [
                'min_range' => 1,
                'max_range' => 20,
                'default' => 1
            ]
        ]);
    }


    private function validateBank($input): int
    {
        return filter_var($input,  FILTER_VALIDATE_INT, 
        [
            'options' => [
                'min_range' => 0,  // Ensure non-negative
                'max_range' => 25,
                'default' => 0  // Fallback to null if invalid
            ]
        ]);
    }


    private function validateMortgaged($input): string
    {
        // Convert input to uppercase and trim whitespace
        $sanitized = strtoupper(trim((string)$input));

        // Check if input is exactly 'YES' or 'NO'
        if ($sanitized === 'YES' || $sanitized === 'NO') {
            return $sanitized;
        }

        // Default to 'NO' if input is invalid
        return 'NO';
    }




    private function validateEmail(string $input): string
    {
        $email = filter_var($input, FILTER_VALIDATE_EMAIL);
        // Return validated email or empty string if invalid
        return $email ?: '';
    }

    private function validateGender(string $input): string
    {
        // Normalize input (uppercase, trim)
        $gender = strtoupper(trim($input));
        // Strict validation - only 'MALE' or 'FEMALE' allowed
        if ($gender === 'MALE' || $gender === 'FEMALE') {
            return $gender;
        }
        // Default to 'MALE' if invalid input
        return 'MALE';
    }

    private function validateOption(string $input): string
    {
 
        // Strict validation - only 'Personal' or 'Authorized Representative' allowed
        if ($input === 'Personal' || $input === 'Authorized Representative') {
            return $input;
        }
        // Default to 'Personal' if invalid input
        return 'Personal';
    }


    private function validatePhilippinesZipCode($input): ?string
    {
        // Philippine zip codes are 4 digits
        $zipCodePattern = '/^(\d{4})$/';
        
        if (preg_match($zipCodePattern, $input)) {
            // Optional: You can add additional validation for specific postal zones if needed
            return $input;
        }
        
        return null;
    }


    private function validatePlanName(string $input): ?string
    {
        // Check if the plan name exists in the membership_plantype table
        $planExists = PlanType::where('plan_name', $input)->exists();
        
        // Return the input if it exists, otherwise return null
        return $planExists ? $input : '';
    }

    private function validateFuelType(string $input): string
    {
        if(empty($input)){
            return 'GAS';
        }
        // Normalize input (uppercase, trim)
        $fueltype = strtoupper(trim($input));
        // Strict validation - only 'GAS' or 'DIESEL' or 'ELECTRIC' allowed
        if ($fueltype === 'GAS' || $fueltype === 'DIESEL' || $fueltype === 'ELECTRIC') {
            return $fueltype;
        }
        // Default to 'GAS' if invalid input
        return 'GAS';
    }


    /**
     * Validate license expiration date
     * 
     * @param string $input License expiration date input
     * @return string Validated date in Y-m-d format or current date if invalid
     */
    private function validateLicenseExpirationDate(string $input): string
    {
        try {
            // Try to parse the date in m/d/Y format
            $parsedDate = \Carbon\Carbon::createFromFormat('m/d/Y', $input);
            
            // Ensure the date is in the future
            if ($parsedDate->isFuture()) {
                // Return the date in Y-m-d format
                return $parsedDate->format('Y-m-d');
            }
            
            // If the date is not in the future, return current date
            return \Carbon\Carbon::now()->format('Y-m-d');
        } catch (\Exception $e) {
            // If date parsing fails, return current date
            return \Carbon\Carbon::now()->format('Y-m-d');
        }
    }

  /**
 * Validate DL Code Array
 * 
 * @param mixed $input DL Code input
 * @return array Validation result
 */
private function validateDLCode($input): array
{
    // If input is empty, return null with is_dlcode = 1
    if (empty($input)) {
        return [
            'members_licensedlcode' => null,
            'is_dlcode' => 1
        ];
    }

    try {
        // If input is already an array, use it directly
        $restriction_array = is_array($input) ? $input : json_decode($input, true);
        
        // Validate that decoded input is an array
        if (!is_array($restriction_array)) {
            return [
                'members_licensedlcode' => null,
                'is_dlcode' => 1
            ];
        }

        // Create indexed array starting from 1
        $indexed_array = array_combine(
            range(1, count($restriction_array)), 
            array_values($restriction_array)
        );

        return [
            'members_licensedlcode' => serialize($indexed_array),
            'is_dlcode' => 2
        ];
    } catch (\Exception $e) {
        // If anything goes wrong, return default
        return [
            'members_licensedlcode' => null,
            'is_dlcode' => 1
        ];
    }
}

    /**
     * Validate License Restrictions
     * 
     * @param mixed $input Restrictions input
     * @return string|null Serialized restrictions or null
     */
    private function validateLicenseRestrictions($input): ? array
    {
        // If input is empty or null, return null
        if (empty($input) || $input === '') {
            return null;
        }

        // Ensure input is an array
        $input = is_array($input) ? $input : [];

        // Create indexed array starting from 1
        $restriction = array_combine(
            range(1, count($input)), 
            array_values($input)
        );

        //     $sr = serialize($restriction);
        //     $array["members_licenserest"] = $sr;

        
        // Serialize the restriction array
        return serialize($restriction);
    }


    /**
     * Validate Plan Type Details
     * 
     * @param string $input Plan type input
     * @return array Validated plan type details
     */
    private function validatePIDPPlanTypeDetails($input): array
    {
        // Default return values
        $result = [
            'plantype_id' => 0,
            'plan_type' => '',
            'pidp_plantype' => ''
        ];

        // Ensure input is a string
        $input = (string) $input;

        // Validate plan type based on specific IDs
        switch ($input) {
            case '3':
                $result['plantype_id'] = '3';
                $result['plan_type'] = 'ANNUAL FEE (REGULAR)';
                $result['pidp_plantype'] = 'ANNUAL (PIDP)';
                break;
            case '14':
                $result['plantype_id'] = '14';
                $result['plan_type'] = 'TWO YEAR FEE (REGULAR)';
                $result['pidp_plantype'] = 'TWO YEARS (PIDP)';
                break;
            case '6':
                $result['plantype_id'] = '6';
                $result['plan_type'] = 'THREE YEAR FEE (REGULAR)';
                $result['pidp_plantype'] = 'THREE YEARS (PIDP)';
                break;
            default:
                $result['plantype_id'] = 0;
                $result['plan_type'] = '';
                $result['pidp_plantype'] = '';
                break;
        }

        return $result;
    }


    /**
     * Validate boolean input
     * 
     * @param mixed $input Input to convert to boolean
     * @return bool Validated boolean value
     */
    private function validateBoolean($input): int
    {
        if (is_bool($input)) {
            return $input ? 1 : 0;
        }
    
        // Convert to string and lowercase for consistent checking
        $input = strtolower(trim((string)$input));
    
        // Check for truthy values
        $trueValues = ['true', '1', 'yes', 'y', 'on', 'agree'];
        // Check for falsy values
        $falseValues = ['false', '0', 'no', 'n', 'off', 'disagree'];
    
        if (in_array($input, $trueValues)) {
            return 1;
        }
    
        if (in_array($input, $falseValues)) {
            return 0;
        }
    
        // Default to 0 if no match
        return 0;
    }


    private function validateCivilStatus(string $input): string
    {
        if(empty($input)){
            return 'SINGLE';
        }
        // Normalize input (uppercase, trim)
        $status = strtoupper(trim($input));
        // Strict validation - only 'SINGLE' or 'MARRIED' or 'WIDOWED' allowed
        if ($status === 'SINGLE' || $status === 'MARRIED' || $status === 'WIDOWED') {
            return $status;
        }
        // Default to 'SINGLE' if invalid input
        return 'SINGLE';
    }

    private function validateMailingPreference(string $input): string
    {
        if(empty($input)){
            return 'HOUSE ADDRESS';
        }
        // Normalize input (uppercase, trim)
        $status = strtoupper(trim($input));
        // Strict validation - only 'HOUSE ADDRESS' or 'OFFICE ADDRESS' allowed
        if ($status === 'HOUSE ADDRESS' || $status === 'OFFICE ADDRESS') {
            return $status;
        }
        // Default to 'SINGLE' if invalid input
        return 'HOUSE ADDRESS';
    }

    private function validateDateRange(string $input): ?string
    {
        // Regex pattern to match MM/DD/YYYY - MM/DD/YYYY format
        $pattern = '/^\d{2}\/\d{2}\/\d{4}\s*-\s*\d{2}\/\d{2}\/\d{4}$/';
        
        if (!preg_match($pattern, $input)) {
            return null;
        }
        
        try {
            // Split the date range
            $dates = explode('-', $input);
            $startDate = trim($dates[0]);
            $endDate = trim($dates[1]);
            
            // // Parse dates using Carbon
            // $parsedStartDate = \Carbon\Carbon::createFromFormat('m/d/Y', $startDate);
            // $parsedEndDate = \Carbon\Carbon::createFromFormat('m/d/Y', $endDate);
            
            // // Validate that end date is not before start date
            // if ($parsedEndDate->lt($parsedStartDate)) {
            //     return null;
          //  }
            
            // Return the original input if all validations pass
            return $input;
        } catch (\Exception $e) {
            return null;
        }
    }


    /**
     * Validate single date format
     * 
     * @param string $input Single date input
     * @return string|null Validated date or null if invalid
     */
    private function validateSingleDate(string $input): ?string
    {
        // Regex pattern to match MM/DD/YYYY format
        $pattern = '/^\d{2}\/\d{2}\/\d{4}$/';
        
        if (!preg_match($pattern, $input)) {
            return null;
        }

        return $input;
       
    }


    private function validateInteger(string $input): ?int
    {
        // Remove any whitespace
        $input = trim($input);
        
        // Check if input is numeric and contains only digits
        if (!preg_match('/^\d+$/', $input)) {
            return null;
        }
        
        // Convert to integer and validate range
        $value = intval($input);
        
        // Optional: You can add range validation if needed
        // For example, if you want to ensure the number is positive
        if ($value <= 0) {
            return null;
        }
        
        return $value;
    }


}