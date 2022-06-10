<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'የ :attribute ግብዓት ቅቡል መሆን አለበት።',
    'accepted_if' => 'የ :attribute ግብዓት የ :other ግብዓት  :value በሚሆንበት ጊዜ ቅቡል መሆን አለበት።',
    'active_url' => 'የ :attribute ግብዓት ልክ ያልሆነ ዩ.አር.ኤል ነው።',
    'after' => 'የ :attribute ግብዓት ቀን ከ :date ቀን በኋላ መሆን አለበት።',
    'after_or_equal' => 'የ :attribute ግብዓት ቀን ከ :date ቀን እኩል ወይም በኋላ መሆን አለበት።',
    'alpha' => 'የ :attribute ግብዓት ማካተት ያለበት ፊደላትን ብቻ ነው።',
    'alpha_dash' => 'የ :attribute ግብዓት ማካተት ያለበት ፊደላትን, ቁጥሮችን, ዳሾችንና የታች መስመር ምልክቶችን ብቻ ነው።',
    'alpha_num' => 'የ :attribute ግብዓት ማካተት ያለበት ቁጥሮችንና ፊደላትን ብቻ ነው።',
    'array' => 'የ :attribute ግብዓት ድርድር ስብስብ መሆን አለበት።',
    'before' => 'የ :attribute ግብዓት ቀን ከ :date ቀን በኋላ መሆን አለበት።',
    'before_or_equal' => 'የ :attribute ግብዓት ከ ቀን :date ቀድሞ ወይም እኩል መሆን አለበት።',
    'between' => [
        'array' => 'የ :attribute ግብዓት በ :min እና :max መካከል መሆን አለበት።',
        'file' => 'የ :attribute ግብዓት በኪሎ ባይት በ :min እና በ :max መካከል መሆን አለበት።',
        'numeric' => 'የ :attribute ግብዓት በ :min እና በ :max መሆን አለበት።',
        'string' => 'የ :attribute ግብዓት በቁምፊ ብዛት በ :min እና :max መካከል መሆን አለበት።',
    ],
    'boolean' => 'የ :attribute ግብዓት እውነት ወይም ሀሰት መሆን አለበት።',
    'confirmed' => 'የ :attribute ማረጋጋጫ አልተመሳሰለም።',
    'current_password' => 'የተሳሳተ የይለፍ ቃል ነው።',
    'date' => 'የ :attribute ግብዓት ልክ ያልሆነ የቀን ግብዓት ነው።',
    'date_equals' => 'የ :attribute ቀን ግብዓት ከ :date ጋር እኩል መሆን አለበት።',
    'date_format' => 'የ :attribute ግብዓት ቅርጸት ከ :format ቅርጸት ጋር አይመሳሰልም።',
    'declined' => 'የ :attribute ግብዓት ቅቡል ያልሆነ መሆን አለበት።',
    'declined_if' => 'የ :attribute ግብዓት የ :other ግብዓት :value በሚሆንበት ጊዜ ቅቡል መሆን የለበትም።',
    'different' => 'የ :attribute ግብዓት እና የ :other ቃጋ የተለያየ መሆን አለበት።',
    'digits' => 'የ :attribute ግብዓት :digits ያህል አሃዞች መሆን አለበት።',
    'digits_between' => 'የ :attribute ግብዓት በ :min እና በ :max አሃዞች መካከል መሆን አለበት።',
    'dimensions' => 'የ :attribute ልክ ያልሆነ የምስል መጠን ልኬት አለው!',
    'distinct' => 'የ :attribute field has a duplicate value.',
    'email' => 'የ :attribute ትክክለኛ የኢ-ሜይል አድራሻ መሆን አለበት።',
    'ends_with' => 'የ :attribute ግብዓት መጨረስ ያለበት ከ : :values ውስጥ ቢያንስ በአንዱ ነው።',
    'enum' => 'የተመረጠው :attribute ግብዓት ልክ አይደለም።',
    'exists' => 'የተመረጠው :attribute ግብዓት ልክ አይደለም።',
    'file' => 'የ :attribute ግብዓት ፋይል መሆን አለበት።',
    'filled' => 'የ :attribute ግብዓት የሆነ ዋጋ መያዝ አለበት።',
    'gt' => [
        'array' => 'የ :attribute ግብዓት ቢያንስ :value ነጠላ አይነቶችን ማካተት አለበት።',
        'file' => 'የ :attribute ግብዓት በኪሎ-ባይት ልኬት ከ :value መብለጥ አለበት።',
        'numeric' => 'የ :attribute ግብዓት በቁጥር ልኬት ከ :value መብለጥ አለበት።',
        'string' => 'የ :attribute ግብዓት በቁምፊ ብዛት ከ :value ቁምፊዎች በላይ መሆን አለበት።',
    ],
    'gte' => [
        'array' => 'የ :attribute ግብዓት በነጠላ አይነቶች ብዛት ከ :value እኩል ወይም በላይ መያዝ አለበት። ',
        'file' => 'የ :attribute ግብዓት መጠን በኪሎ-ባይት ከ :value እኩል ወይም በላይ መሆን አለበት።',
        'numeric' => 'የ :attribute ግብዓት መሆን በቁጥር ስሌት ከ :value እኩል ወይም መብለጥ አለበት።',
        'string' => 'የ :attribute ግብዓት በቁምፊ ብዛት :value ያህል ወይም በላይ ቁምፊዎችን ማካተት አለበት። ',
    ],
    'image' => 'የ :attribute ግብዓት ምስል/ፎቶ መሆን አለበት።',
    'in' => 'የተመረጠው የ :attribute ግብዓት ልክ አይደለም።',
    'in_array' => 'የ :attribute ግብዓት በ :other ውስጥ አልተገኘም።',
    'integer' => 'የ :attribute ግብዓት መቍጠሪያ ቍጥር መሆን አለበት።',
    'ip' => 'የ :attribute ግብዓት ትክክለኛ የበይነመረብ ፕሮቶኮል አድራሻ መሆን አለበት።',
    'ipv4' => 'የ :attribute ግብዓት ትክክለኛ የበይነመረብ ፕሮቶኮል አድራሻ ስሪት 4 /IPv4/ መሆን አለበት።',
    'ipv6' => 'የ :attribute ግብዓት ትክክለኛ የበይነመረብ ፕሮቶኮል አድራሻ ስሪት 6 /IPv6/ መሆን አለበት።',
    'json' => 'የ :attribute ግብዓት ትክክለኛ የJSON ሕብረ-ቁምፊ መሆን አለበት።',
    'lt' => [
        'array' => 'የ :attribute ግብዓት ከ :value በታች ነጠላ አይነቶችን መያዝ አለበት።',
        'file' => 'የ :attribute ግብዓት መጠኑ ከ :value ኪሎ-ባይት በታች መሆን አለበት።',
        'numeric' => 'የ :attribute must be less than :value.',
        'string' => 'የ :attribute ግብዓት መጠኑ ከ :value ቁምፊዎች በታች መሆን አለበት።',
    ],
    'lte' => [
        'array' => 'የ :attribute ግብዓት ከ :value ነጠላ አይነቶች በላይ መሆን የለበትም።',
        'file' => 'የ :attribute ግብዓት መጠኑ ከ :value ኪሎ-ባይት ያህል ወይም በታች መሆን አለበት።',
        'numeric' => 'የ :attribute ግብዓት በቁጥር ከ :value እኩል ወይም በታች መሆን አለበት።',
        'string' => 'የ :attribute ግብዓት በቁምፊ ብዛት ከ :value እኩል ወይም በታች መሆን አለበት።',
    ],
    'mac_address' => 'የ :attribute ግብዓት ትክክለኛ የማስተላለፊያ መዳረሻ ቁጥጥር /MAC/ መሆን አለበት።',
    'max' => [
        'array' => 'የ :attribute ግብዓት ከ :max በላይ ነጠላ አይነቶችን መያዝ የለበትም።',
        'file' => 'የ :attribute ግብዓት መጠኑ ከ :max ኪሎ-ባይት በላይ መሆን የለበትም።',
        'numeric' => 'የ :attribute ግብዓት በቁጥር ከ :max በላይ መሆን የለበትም።',
        'string' => 'የ :attribute ግብዓት በቁምፊ ብዛት ከ :max ቁምፊዎች መብለጥ የለበትም።',
    ],
    'mimes' => 'የ :attribute ግብዓት አይነት ከ: :values ውጭ መሆን የለበትም።',
    'mimetypes' => 'የ :attribute ግብዓት በአይነቱ ከ: :values ውስጥ መሆን አለበት።',
    'min' => [
        'array' => 'የ :attribute ግብዓት ቢያንስ :min ነጠላ አይነቶችን መያዝ አለበት።',
        'file' => 'የ :attribute ግብዓት መጠኑ ቢያንስ :min ኪሎ-ባይት መሆን አለበት።',
        'numeric' => 'የ :attribute ዋጋ ቢያንስ :min መሆን አለበት።',
        'string' => 'የ :attribute ግብዓት ቢያንስ :min ቁምፊዎችን መያዝ አለበት።',
    ],
    'multiple_of' => 'የ :attribute ዋጋ የ :value ብዜት መሆን አለበት።',
    'not_in' => 'የተመረጠው የ :attribute ግብዓት ልክ አይደለም።',
    'not_regex' => 'የ :attribute ቅርጸት ልክ አይደለም።',
    'numeric' => 'የ :attribute ቁጥር መሆን አለበት።',
    'present' => 'የ :attribute ግብዓት መኖር አለበት።',
    'prohibited' => 'የ :attribute ግብዓት የተከለከለ ነው።',
    'prohibited_if' => 'የ :attribute field ግብዓት የ :other ዋጋ :value እከሆነ ድረስ የተከለከለ ነው።',
    'prohibited_unless' => 'የ :attribute ግብዓት የ :other ግብዓት በ :values ውስጥ እስካለ ድረስ የተከለከለ ነው።',
    'prohibits' => 'የ :attribute ግብዓት የ :other ን ዋጋ መኖር ይከለክላል።',
    'regex' => 'የ :attribute ቅርጸት ልክ አይደለም።',
    'required' => 'የ :attribute ግብዓት የግድ አስፈላጊ ነው።',
    'required_array_keys' => 'የ :attribute field must contain entries for: :values.',
    'required_if' => 'የ :attribute field is required when :other is :value.',
    'required_unless' => 'የ :attribute field is required unless :other is in :values.',
    'required_with' => 'የ :attribute ግብዓት የ :values ግብዓት ካለ የግድ አስፈላጊ ነው።',
    'required_with_all' => 'የ :attribute ግብዓት የ :values ግብዓቶች በሚኖሩበት ጊዜ የግድ አስፈላጊ ነው።',
    'required_without' => 'የ :attribute ግብዓት የ :values ግብዓት በማይኖርበት ጊዜ የግድ አስፈላጊ ነው።',
    'required_without_all' => 'የ :attribute ግብዓት የ :values ግብዓቶች ከሌሉ የግድ አስፈላጊ ነው።',
    'same' => 'የ :attribute ግብዓት እና :other ግብዓት ተመሳሳይ መሆን አለበት።',
    'size' => [
        'array' => 'የ :attribute ግብዓት :size ያህል ነጠላ አባላትን መያዝ አለበት።',
        'file' => 'የ :attribute ግብዓት በኪሎ-ባይት :size ያህል መሆን አለበት።',
        'numeric' => 'የ :attribute ግብዓት መጠኑ :size መሆን አለበት።',
        'string' => 'የ :attribute ግብዓት መጠኑ :size ቅርጸትችን መሆን አለበት።',
    ],
    'starts_with' => 'የ :attribute ግብዓት መጀመር ያለበት ከ : :values በአንዱ ነው።',
    'string' => 'የ :attribute ግብዓት ሕብረ-ቁምፊ መሆን አለበት።',
    'timezone' => 'የ :attribute ግብዓት ትክክለኛ የጊዜ ልኬት ዞን መሆን አለበት።',
    'unique' => 'የ :attribute ግብዓትዎ አስቀድሞ በሌላ ትይዟል።',
    'uploaded' => 'የ :attribute ሰቀላ አልተሳካም።',
    'url' => 'የ :attribute ግብዓት ትክክለኛ ወጥ መረጃ አመልካች/ዩ.አር.ኤል መሆን አለበት።',
    'uuid' => 'የ :attribute ግብዓት ትክክለኛ ሁለንተናዊ ልዩ መለያ መሆን አለበት።',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
