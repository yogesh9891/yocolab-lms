<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>
    <style>
        table, td, div, h1, p {font-family: 'Montserrat', sans-serif!important;}
    </style>
</head>
<body style="margin:0;padding:0;">
    <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:url('{{asset('front_assets/images/grad2.jpg')}}'); background-repeat: repeat; background-size: cover;">
        <tr>
            <td align="center" style="padding:0;">
                <table role="presentation" style="width:607px;border-collapse:collapse;border-spacing:0; background:  #ffffff;text-align:left;">
                    
                                  <tr>
                                        <td style="margin-top: 30px; padding: 5px 0; background: #18056b;" colspan="2">
                                            <table role="presentation" style="width: 69%;margin: auto;border-collapse:collapse;border:0;border-spacing:0;">
                                                <tr>
                                                    
                                                    </tr>
                                            </table>
                                        </td>
                                    </tr>
                    <tr>
                        <td style="padding: 0 0 0 20px;width:50%;" align="left">
                            
                            <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                                <tr>
                                    <td style="padding:0;width:5%;">
                                        <img src="{{asset('front_assets/images/yo.png')}}" alt="" width="70" style="height:auto;display:inline-block; position: relative;" /> 
                                                                
                                    </td>
                                                            
                                    <td style="padding:0;width:50%;">
                                        <span style="display: inline-block; text-transform: uppercase; color: #000000; font-size: 25px; font-weight: 400;font-family:'montserrat' , sans-serif!important;">INVOICE</span>
                                    </td>
                                    </tr>
                            </table>
                           
                           
                                                                
                        </td>
                                                            
                        <td style="padding: 0 20px 0 0;width:50%;" align="right">
                            <p style="display: inline-block; text-transform: uppercase; color: #000000; font-size: 25px; font-weight: 400;font-family:'montserrat' , sans-serif!important;text-align: center;line-height: 31px;">Cancellation Charge</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="margin-top: 30px; padding: 20px 0; background: #18056b;" colspan="2">
                            <table role="presentation" style="width: 69%;margin: auto;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                    <td style="width: 56%;">
                                       <span style="color: #ffffff; font-size: 13px; font-weight: 400;">Class Name</span>  
                                                                
                                    </td>
                                                            
                                    <td style="width: 50%;">
                                       <span style="color: #ffffff; font-size: 13px; font-weight: 400;">{{$details['title']}}</span>  
                                                                
                                    </td>
                                    </tr>
                                    <tr>
                                    <td style="width: 56%;">
                                       <span style="color: #ffffff; font-size: 13px; font-weight: 400;">Date</span>  
                                                                
                                    </td>
                                                            
                                    <td style="width: 50%;">
                                       <span style="color: #ffffff; font-size: 13px; font-weight: 400;">{{$details['date']}}</span>  
                                                                
                                    </td>
                                    </tr>
                                    <tr>
                                    <td style="width: 56%;">
                                       <span style="color: #ffffff; font-size: 13px; font-weight: 400;">Time</span>  
                                                                
                                    </td>
                                                            
                                    <td style="width: 50%;">
                                       <span style="color: #ffffff; font-size: 13px; font-weight: 400;">{{$details['time']}}</span>  
                                                                
                                    </td>
                                    </tr>
                                    <tr>
                                    <td style="width: 56%;">
                                       <span style="color: #ffffff; font-size: 13px; font-weight: 400;">Students Enrolled</span>  
                                                                
                                    </td>
                                                            
                                    <td style="width: 50%;">
                                       <span style="color: #ffffff; font-size: 13px; font-weight: 400;">{{$details['qty']}}</span>  
                                                                
                                    </td>
                                    </tr>
                            </table>
                        </td>
                    </tr>

                    
                    <tr>
                        <td style="padding:36px 30px 42px 30px; width: 100%;" colspan="2">
                            <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                    <th style="border-bottom: 2px solid #7e7e7e; text-align: center; padding-bottom: 4px;">
                                       <p style="margin-bottom: 0; color: #7e7e7e;font-size: 14px; font-weight: 400;">Description</p> 
                                    </th>
                                    <th style="border-bottom: 2px solid #7e7e7e; text-align: center; padding-bottom: 4px;">
                                       <p style="margin-bottom: 0; color: #7e7e7e;font-size: 14px; font-weight: 400;">Class Fee</p> 
                                    </th>
                                    <th style="border-bottom: 2px solid #7e7e7e; text-align: center; padding-bottom: 4px;">
                                       <p style="margin-bottom: 0; color: #7e7e7e;font-size: 14px; font-weight: 400;">Cancellation Charges</p> 
                                    </th>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">
                                       <p style="margin-bottom: 0; color: #7e7e7e;font-size: 14px; font-weight: 400;">Cancellation Fee </p> 
                                    </td>
                                    <td style="text-align: center;">
                                       <p style="margin-bottom: 0; color: #7e7e7e;font-size: 14px; font-weight: 400;">{{$details['price']}}</p> 
                                    </td>
                                    <td style="text-align: center;">
                                       <p style="margin-bottom: 0; color: #7e7e7e;font-size: 14px; font-weight: 400;">{{$details['total']}}</p> 
                                    </td>
                                </tr>
                               
                            </table>
                        </td>
                    </tr>
                     <tr>
                        <td style="background: #ffffff; width: 100%; padding: 40px 0;"></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="background: #d6d5d5; padding: 40px 0 25px;">
                            <table role="presentation" style="border-collapse:collapse;border-spacing:0;width: 90%;margin: auto;border-top: 2px solid #7e7e7e;border-bottom: 2px solid #7e7e7e;">
                                
                                <tr>
                                    <td style="padding-top: 15px; width: 78%;">
                                       <p style="margin-bottom: 0; margin-top: 0; color: #7e7e7e;font-size: 12px; font-weight: 400;">Cancellation Charge</p> 
                                    </td>
                                    <td style="padding-top: 15px; width:50%;">
                                       <p style="margin-bottom: 0; margin-top: 0; color: #7e7e7e;font-size: 12px; font-weight: 400;">{{$details['total']}}</p> 
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td style="padding: 0; width: 78%;">
                                       <p style="margin-bottom: 0; margin-top: 0; color: #7e7e7e;font-size: 12px; font-weight: 400;">Total Students</p> 
                                    </td>
                                    <td style="padding: 0; width:50%;">
                                       <p style="margin-bottom: 0; margin-top: 0; color: #7e7e7e;font-size: 12px; font-weight: 400;">{{$details['qty']}}</p> 
                                    </td>
                                    
                                </tr>

                                <tr>
                                    <td style="padding-bottom: 10px; width: 78%;">
                                       <p style="margin-bottom: 0; margin-top: 10px; color: #7e7e7e;font-size: 15px; font-weight: 400;">Total Cancellation Charge</p> 
                                    </td>
                                    <td style="padding-bottom: 10px; width:50%;">
                                       <p style="margin-bottom: 0; margin-top: 10px; color: #fd6100;font-size: 20px; font-weight: 400;">{{$details['cfee']}}</p> 
                                    </td>
                                    
                                </tr>

                                
                               
                            </table>

                            <table role="presentation" style="border-collapse:collapse;border-spacing:0;width: 50%;margin-left: 30px;">
                                <tr>
                                    <td style="padding:30px 0 20px 0;">
                                        <a href="{{url('/teacher/dashboard')}}" style="color:#ffffff; background:#18056b; text-align: center; font-size: 12px;font-weight: 500;padding: 12px 44px 12px 44px; text-decoration: none; font-family:'montserrat' , sans-serif!important; text-transform: uppercase;">Go To Dashboard</a>
                                    </td>
                                </tr>
                            </table>

                            <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                    <td style="padding:0px 0 0 30px;color:#7e7e7e; text-align: left;">
                                        <p style="font-size:11px;line-height: 1.6;font-family: 'Montserrat', sans-serif!important;font-weight: 400; margin-bottom: 0;">Cancellation Policy</p>                                       
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0px 0 0 30px;color:#7e7e7e; text-align: left;">
                                        <p style="font-size:11px;line-height: 1.6;font-family: 'Montserrat', sans-serif!important;font-weight: 400; margin-bottom: 0; margin-top: 0;">1) Cancellation 24 hours prior to scheduled class: 10% of total class fees</p>                                       
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0px 0 0 30px;color:#7e7e7e; text-align: left;">
                                        <p style="font-size:11px;line-height: 1.6;font-family: 'Montserrat', sans-serif!important;font-weight: 400; margin-bottom: 0; margin-top: 0;">2) Cancellation 24 hours within 24 hours prior to scheduled class: 15% of total class fees</p>                                       
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0px 0 0 30px;color:#7e7e7e; text-align: left;">
                                        <p style="font-size:11px;line-height: 1.6;font-family: 'Montserrat', sans-serif!important;font-weight: 400; margin-bottom: 0; margin-top: 0;">Refer to Yocolab cancellation policy for more information.</p>                                       
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0px 0 0 30px;color:#7e7e7e; text-align: left;">
                                        <p style="font-size:11px;line-height: 1.6;font-family: 'Montserrat', sans-serif!important;font-weight: 400; margin-bottom: 0; margin-top: 5px;">* This amount will be debited from your registered card on Yocolab</p>                                       
                                    </td>
                                </tr>
                                
                               
                            </table>
                        </td>
                    </tr>
                   
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

    