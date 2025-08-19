<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <meta name="format-detection" content="telephone=no,address=no,email=no,date=no,url=no">
    <title>Exception Notification</title>
    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings>
                <o:AllowPNG/>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <![endif]-->
    <!--[if mso]>
    <style type="text/css">
        table, td, div, h1, h2, h3, h4, h5, h6, p {
            font-family: Arial, sans-serif !important;
        }
    </style>
    <![endif]-->
    <style type="text/css">
        /* Base styles - fluid layout */
        .email-container {
            max-width: 600px;
            width: 100%;
            margin: 0 auto;
            background-color: #ffffff;
        }
        
        /* Responsive table base styles */
        .responsive-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto;
        }
        
        .responsive-cell {
            padding: 12px;
            vertical-align: top;
            border-bottom: 1px solid #e9ecef;
            word-wrap: break-word;
        }
        
        /* Stack trace specific styling */
        .stack-trace-container {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        /* Responsive breakpoints */
        @media screen and (max-width: 700px) {
            .email-container {
                width: 100% !important;
                max-width: 100% !important;
            }
            
            .mobile-container {
                padding: 10px !important;
            }
            
            .mobile-padding {
                padding: 15px 20px !important;
            }
            
            .mobile-font-size {
                font-size: 16px !important;
            }
            
            .mobile-small-font {
                font-size: 11px !important;
            }
            
            .mobile-center {
                text-align: center !important;
            }
            
            .mobile-table {
                width: 100% !important;
                min-width: 280px !important;
            }
            
            /* Transform stack trace table to card layout */
            .stack-trace-table {
                border: none !important;
            }
            
            .stack-trace-table thead {
                display: none !important;
            }
            
            .stack-trace-table tr {
                display: block !important;
                margin-bottom: 15px !important;
                border: 1px solid #e9ecef !important;
                border-radius: 6px !important;
                background-color: #fff !important;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
                overflow: hidden !important;
            }
            
            .stack-trace-table td {
                display: block !important;
                border: none !important;
                padding: 12px 15px !important;
                text-align: left !important;
                border-bottom: 1px solid #f1f1f1 !important;
                position: relative !important;
            }
            
            .stack-trace-table td:last-child {
                border-bottom: none !important;
            }
            
            /* Add labels to mobile stack trace */
            .stack-trace-table td:before {
                content: attr(data-label) ": " !important;
                font-weight: bold !important;
                color: #495057 !important;
                font-size: 11px !important;
                text-transform: uppercase !important;
                letter-spacing: 0.5px !important;
                margin-bottom: 5px !important;
                display: block !important;
            }
            
            .stack-trace-table td[data-label="Index"]:before {
                content: "#" attr(data-label) ": " !important;
            }
            
            /* Special styling for mobile stack trace content */
            .stack-mobile-index {
                background-color: #f8f9fa !important;
                font-weight: bold !important;
                font-size: 16px !important;
                text-align: center !important;
            }
            
            .stack-mobile-file {
                font-family: 'Consolas', 'Monaco', monospace !important;
                font-size: 12px !important;
            }
            
            .stack-mobile-method {
                font-family: 'Consolas', 'Monaco', monospace !important;
                font-size: 11px !important;
            }
            
            .stack-mobile-source {
                text-align: center !important;
            }
        }

        @media screen and (max-width: 480px) {
            .mobile-container {
                padding: 5px !important;
            }
            
            .mobile-padding {
                padding: 10px 15px !important;
            }
            
            .mobile-font-size {
                font-size: 14px !important;
            }
            
            .mobile-small-font {
                font-size: 10px !important;
            }
            
            .stack-trace-table td {
                padding: 10px 12px !important;
            }
            
            .stack-mobile-file {
                font-size: 11px !important;
            }
            
            .stack-mobile-method {
                font-size: 10px !important;
            }
        }
        
        /* Medium screens adjustment */
        @media screen and (min-width: 701px) and (max-width: 900px) {
            .email-container {
                width: 95% !important;
                max-width: 95% !important;
            }
            
            .responsive-table {
                font-size: 13px !important;
            }
            
            .responsive-cell {
                padding: 10px !important;
            }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; width: 100%; background-color: #f4f4f4; font-family: Arial, sans-serif; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
    <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
        Exception Alert: {{ $exceptionData['exception_class'] }} in {{ $exceptionData['app_name'] }}
    </div>

    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f4f4f4; padding: 20px 0;">
        <tr>
            <td align="center" style="padding: 0;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="email-container" style="max-width: 600px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden;">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background-color: #dc3545; padding: 30px 40px; text-align: center;" class="mobile-padding mobile-center">
                            <h1 style="margin: 0; color: #ffffff; font-size: 28px; font-weight: bold; line-height: 1.2;" class="mobile-font-size">
                                🚨 Exception Alert
                            </h1>
                            <p style="margin: 10px 0 0 0; color: #ffffff; font-size: 16px; opacity: 0.9;" class="mobile-small-font">
                                {{ $exceptionData['app_name'] }} ({{ strtoupper($exceptionData['environment']) }})
                            </p>
                        </td>
                    </tr>

                    <!-- Alert Box -->
                    <tr>
                        <td style="padding: 30px 40px 0 40px;" class="mobile-padding">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f8d7da; border: 1px solid #f5c6cb; border-radius: 6px;">
                                <tr>
                                    <td style="padding: 20px; color: #721c24;" class="mobile-padding">
                                        <h2 style="margin: 0 0 8px 0; font-size: 18px; font-weight: bold;" class="mobile-font-size">
                                            {{ $exceptionData['exception_class'] }}
                                        </h2>
                                        <p style="margin: 0; font-size: 14px; line-height: 1.5;" class="mobile-small-font">
                                            {{ $exceptionData['message'] }}
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Exception Details Section -->
                    <tr>
                        <td style="padding: 30px 40px 0 40px;" class="mobile-padding">
                            <h3 style="margin: 0 0 20px 0; color: #495057; font-size: 18px; border-bottom: 2px solid #e9ecef; padding-bottom: 10px;" class="mobile-font-size">
                                Exception Details
                            </h3>
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="padding: 8px 0; border-bottom: 1px solid #f1f1f1;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td width="140" style="font-weight: bold; color: #495057; font-size: 14px;" class="mobile-small-font">Exception:</td>
                                                <td style="color: #212529; font-size: 14px;" class="mobile-small-font">{{ $exceptionData['exception_class'] }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px 0; border-bottom: 1px solid #f1f1f1;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td width="140" style="font-weight: bold; color: #495057; font-size: 14px;" class="mobile-small-font">Message:</td>
                                                <td style="color: #212529; font-size: 14px; word-break: break-word;" class="mobile-small-font">{{ $exceptionData['message'] }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px 0; border-bottom: 1px solid #f1f1f1;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td width="140" style="font-weight: bold; color: #495057; font-size: 14px;" class="mobile-small-font">File:</td>
                                                <td style="color: #212529; font-size: 14px; word-break: break-all;" class="mobile-small-font">{{ $exceptionData['file'] }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px 0; border-bottom: 1px solid #f1f1f1;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td width="140" style="font-weight: bold; color: #495057; font-size: 14px;" class="mobile-small-font">Line:</td>
                                                <td style="color: #212529; font-size: 14px;" class="mobile-small-font">{{ $exceptionData['line'] }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px 0; border-bottom: 1px solid #f1f1f1;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td width="140" style="font-weight: bold; color: #495057; font-size: 14px;" class="mobile-small-font">Time:</td>
                                                <td style="color: #212529; font-size: 14px;" class="mobile-small-font">{{ $exceptionData['timestamp'] }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px 0;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td width="140" style="font-weight: bold; color: #495057; font-size: 14px;" class="mobile-small-font">Environment:</td>
                                                <td style="color: #212529; font-size: 14px;" class="mobile-small-font">
                                                    <span style="background-color: #e7f3ff; padding: 4px 8px; border-radius: 4px; font-weight: bold;">
                                                        {{ strtoupper($exceptionData['environment']) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    @if(isset($exceptionData['request']))
                    <!-- Request Information Section -->
                    <tr>
                        <td style="padding: 30px 40px 0 40px;" class="mobile-padding">
                            <h3 style="margin: 0 0 20px 0; color: #495057; font-size: 18px; border-bottom: 2px solid #e9ecef; padding-bottom: 10px;" class="mobile-font-size">
                                Request Information
                            </h3>
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 5px; overflow: hidden;">
                                <tr>
                                    <td style="padding: 8px 0; border-bottom: 1px solid #f1f1f1;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td width="140" style="font-weight: bold; color: #495057; font-size: 14px; padding: 0 15px;" class="mobile-small-font">URL:</td>
                                                <td style="color: #007bff; font-size: 14px; word-break: break-all; padding: 0 15px;" class="mobile-small-font">{{ $exceptionData['request']['url'] }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px 0; border-bottom: 1px solid #f1f1f1;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td width="140" style="font-weight: bold; color: #495057; font-size: 14px; padding: 0 15px;" class="mobile-small-font">Method:</td>
                                                <td style="color: #212529; font-size: 14px; padding: 0 15px;" class="mobile-small-font">
                                                    <span style="background-color: #28a745; color: white; padding: 2px 6px; border-radius: 3px; font-size: 12px; font-weight: bold;">
                                                        {{ $exceptionData['request']['method'] }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px 0; border-bottom: 1px solid #f1f1f1;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td width="140" style="font-weight: bold; color: #495057; font-size: 14px; padding: 0 15px;" class="mobile-small-font">IP Address:</td>
                                                <td style="color: #212529; font-size: 14px; padding: 0 15px;" class="mobile-small-font">{{ $exceptionData['request']['ip'] }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                @if(isset($exceptionData['user']))
                                <tr>
                                    <td style="padding: 8px 0; border-bottom: 1px solid #f1f1f1;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td width="140" style="font-weight: bold; color: #495057; font-size: 14px; padding: 0 15px;" class="mobile-small-font">User ID:</td>
                                                <td style="color: #212529; font-size: 14px; padding: 0 15px;" class="mobile-small-font">{{ $exceptionData['user']['id'] ?? 'N/A' }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px 0; border-bottom: 1px solid #f1f1f1;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td width="140" style="font-weight: bold; color: #495057; font-size: 14px; padding: 0 15px;" class="mobile-small-font">User Email:</td>
                                                <td style="color: #212529; font-size: 14px; padding: 0 15px;" class="mobile-small-font">{{ $exceptionData['user']['email'] ?? 'N/A' }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                @endif

                                <tr>
                                    <td style="padding: 8px 0;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td width="140" style="font-weight: bold; color: #495057; font-size: 14px; padding: 0 15px;" class="mobile-small-font">User Agent:</td>
                                                <td style="color: #6c757d; font-size: 12px; word-break: break-all; padding: 0 15px;" class="mobile-small-font">{{ $exceptionData['request']['user_agent'] }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            @if(!empty($exceptionData['request']['parameters']))
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top: 20px;" class="mobile-table">
                                <tr>
                                    <td class="mobile-padding">
                                        <h4 style="margin: 0 0 10px 0; color: #495057; font-size: 16px;" class="mobile-font-size">Request Parameters:</h4>
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f8f9fa; border: 1px solid #e9ecef; border-radius: 4px;">
                                            <tr>
                                                <td style="padding: 15px; font-family: 'Courier New', monospace; font-size: 12px; line-height: 1.4; color: #495057; word-break: break-all;" class="mobile-padding mobile-small-font">
                                                    {{ json_encode($exceptionData['request']['parameters'], JSON_PRETTY_PRINT) }}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            @endif

                            @if(!empty($exceptionData['request']['headers']))
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top: 20px;">
                                <tr>
                                    <td>
                                        <h4 style="margin: 0 0 10px 0; color: #495057; font-size: 16px;">Headers:</h4>
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border: 1px solid #e9ecef; border-radius: 4px;">
                                            @foreach($exceptionData['request']['headers'] as $header => $values)
                                            <tr>
                                                <td style="padding: 8px 12px; border-bottom: 1px solid #f1f1f1; background-color: #f8f9fa; font-weight: bold; font-size: 12px; width: 200px;">
                                                    {{ $header }}
                                                </td>
                                                <td style="padding: 8px 12px; border-bottom: 1px solid #f1f1f1; font-size: 12px; word-break: break-all;">
                                                    {{ is_array($values) ? implode(', ', $values) : $values }}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            @endif
                        </td>
                    </tr>
                    @endif

                    @if(isset($exceptionData['stack_trace_array']) && $config['include_stack_trace'])
                    <!-- Stack Trace Section -->
                    <tr>
                        <td style="padding: 30px 40px 0 40px;" class="mobile-padding">
                            <h3 style="margin: 0 0 20px 0; color: #495057; font-size: 18px; border-bottom: 2px solid #e9ecef; padding-bottom: 10px;" class="mobile-font-size">
                                📋 Stack Trace
                            </h3>
                            
                            <!-- Info notice -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 15px;" class="mobile-table">
                                <tr>
                                    <td style="background-color: #d1ecf1; border: 1px solid #bee5eb; border-radius: 4px; padding: 12px;" class="mobile-padding">
                                        <p style="margin: 0; color: #0c5460; font-size: 13px; line-height: 1.4;" class="mobile-small-font">
                                            💡 <strong>Stack trace information:</strong> Each row shows a step in the execution path. 
                                            The exception origin is at the top, followed by the call stack.
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <!-- Stack Trace Table -->
                            <div class="stack-trace-container">
                            <table border="0" cellpadding="0" cellspacing="0" class="responsive-table stack-trace-table" style="border: 1px solid #e9ecef; border-radius: 5px; overflow: hidden;">
                                <!-- Table Headers -->
                                <thead>
                                <tr style="background-color: #f8f9fa; border-bottom: 2px solid #e9ecef;">
                                    <td style="padding: 10px 12px; font-weight: bold; font-size: 12px; color: #495057; width: 50px;" class="mobile-small-font">#</td>
                                    <td style="padding: 10px 12px; font-weight: bold; font-size: 12px; color: #495057;" class="mobile-small-font">File & Line</td>
                                    <td style="padding: 10px 12px; font-weight: bold; font-size: 12px; color: #495057;" class="mobile-small-font">Method/Function</td>
                                    <td style="padding: 10px 12px; font-weight: bold; font-size: 12px; color: #495057; width: 80px;" class="mobile-small-font">Source</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($exceptionData['stack_trace_array'] as $entry)
                                <tr style="{{ $entry['is_vendor'] ? 'background-color: #f8f9fa;' : ($entry['index'] == 0 ? 'background-color: #fff3cd;' : 'background-color: white;') }}">
                                    <!-- Index -->
                                    <td data-label="Index" class="responsive-cell stack-mobile-index" style="padding: 12px; font-family: monospace; font-size: 11px; color: #6c757d; text-align: center;">
                                        {{ $entry['index'] }}
                                    </td>
                                    
                                    <!-- File & Line -->
                                    <td data-label="File" class="responsive-cell stack-mobile-file" style="padding: 12px;">
                                        <div style="font-family: 'Consolas', 'Monaco', monospace; font-size: 11px; line-height: 1.4;">
                                            <div style="color: {{ $entry['is_vendor'] ? '#6c757d' : '#007bff' }}; font-weight: {{ $entry['index'] == 0 ? 'bold' : 'normal' }};">
                                                {{ $entry['short_file'] }}
                                            </div>
                                            @if($entry['line'] > 0)
                                            <div style="color: #28a745; font-size: 10px; margin-top: 2px;">
                                                Line {{ $entry['line'] }}
                                            </div>
                                            @endif
                                        </div>
                                    </td>
                                    
                                    <!-- Method/Function -->
                                    <td data-label="Method" class="responsive-cell stack-mobile-method" style="padding: 12px;">
                                        @if($entry['index'] == 0)
                                            <div style="color: #dc3545; font-weight: bold; font-size: 12px;">
                                                ⚠️ {{ $entry['function'] }}
                                            </div>
                                            <div style="color: #6c757d; font-size: 10px; margin-top: 2px;">
                                                {{ $entry['class'] }}
                                            </div>
                                        @else
                                            <div style="font-family: 'Consolas', 'Monaco', monospace; font-size: 11px; color: {{ $entry['is_vendor'] ? '#6c757d' : '#495057' }};">
                                                {{ $entry['full_call'] }}
                                            </div>
                                            @if($entry['args'])
                                            <div style="color: #6c757d; font-size: 10px; margin-top: 2px; font-family: monospace;">
                                                {{ $entry['args'] }}
                                            </div>
                                            @endif
                                        @endif
                                    </td>
                                    
                                    <!-- Source Type -->
                                    <td data-label="Source" class="responsive-cell stack-mobile-source" style="padding: 12px; text-align: center;">
                                        @if($entry['index'] == 0)
                                            <span style="background-color: #dc3545; color: white; padding: 2px 6px; border-radius: 3px; font-size: 10px; font-weight: bold;">
                                                ORIGIN
                                            </span>
                                        @elseif($entry['is_vendor'])
                                            <span style="background-color: #6c757d; color: white; padding: 2px 6px; border-radius: 3px; font-size: 10px;">
                                                VENDOR
                                            </span>
                                        @else
                                            <span style="background-color: #007bff; color: white; padding: 2px 6px; border-radius: 3px; font-size: 10px;">
                                                APP
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                
                                <!-- Footer with tips -->
                                <tr>
                                    <td style="background-color: #f8f9fa; padding: 12px 20px; border-top: 2px solid #e9ecef;" colspan="4" class="responsive-cell">
                                        <p style="margin: 0 0 8px 0; color: #6c757d; font-size: 11px; line-height: 1.4;">
                                            💡 <strong>Reading Tips:</strong>
                                        </p>
                                        <ul style="margin: 0; padding-left: 20px; color: #6c757d; font-size: 11px; line-height: 1.4;">
                                            <li><strong>ORIGIN</strong> - Where the exception was thrown</li>
                                            <li><strong>APP</strong> - Your application code (focus here first)</li>
                                            <li><strong>VENDOR</strong> - Third-party library code</li>
                                        </ul>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            </div>
                        </td>
                    </tr>
                    @endif

                    <!-- Action Button -->
                    <tr>
                        <td style="padding: 30px 40px; text-align: center;" class="mobile-padding mobile-center">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mobile-table">
                                <tr>
                                    <td align="center">
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="background-color: #007bff; border-radius: 6px; padding: 12px 24px;" class="mobile-padding">
                                                    <a href="{{ $exceptionData['request']['url'] ?? '#' }}" style="color: #ffffff; text-decoration: none; font-weight: bold; font-size: 14px; display: inline-block;" class="mobile-font-size">
                                                        🔍 View in Application
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8f9fa; padding: 30px 40px; text-align: center; border-top: 1px solid #e9ecef;" class="mobile-padding mobile-center">
                            <p style="margin: 0 0 10px 0; color: #6c757d; font-size: 14px; line-height: 1.5;" class="mobile-font-size">
                                <strong>⚠️ This requires immediate attention</strong>
                            </p>
                            <p style="margin: 0; color: #6c757d; font-size: 12px; line-height: 1.4;" class="mobile-small-font">
                                This email was sent automatically by the Laravel Exception Catcher package.<br>
                                Please investigate and resolve this issue as soon as possible.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
