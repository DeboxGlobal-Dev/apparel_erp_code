<?php
include "inc.php";
include "config/logincheck.php";
?>

<div class="flex-fill overflow-auto">

							<!-- Single mail -->
							<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
							<input name="sendstatus" type="hidden" id="sendstatus" value="11111" />
							<input name="action" type="hidden" id="action" value="composemail" />
							<div class="card">




								<!-- Mail details -->
								<div class="table-responsive">
									<table class="table">
										<tbody>
											<tr>
												<td class="align-top py-0" style="width: 1%">
													<div class="py-2 mr-sm-3">From:</div>
												</td>
												<td class="align-top py-0">
													<div class="d-sm-flex flex-sm-wrap">
														<select id="fromMail" name="fromMail" class="form-control flex-fill w-auto py-2 px-0 border-0 rounded-0" >
														<?php
														$select='';
														$where='';
														$rs='';
														$select='*';
														$where=' status=1  order by id asc';
														$rs=GetPageRecord($select,_EMAIL_SETTING_MASTER_,$where);
														while($rest=mysqli_fetch_array($rs)){
														?>
														<option value="<?php echo $rest['email']; ?>"><?php echo $rest['from_name']; ?> - <?php echo $rest['email']; ?></option>
														<?php } ?>
														</select>


													</div>
												</td>
											</tr>

											<tr>
												<td class="align-top py-0" style="width: 1%">
													<div class="py-2 mr-sm-3">To:</div>
												</td>
												<td class="align-top py-0">
													<div class="d-sm-flex flex-sm-wrap">
														<input type="text" class="form-control flex-fill w-auto py-2 px-0 border-0 rounded-0" placeholder="Add recipients" name="tomail" id="tomail">
													</div>
												</td>
											</tr>
											<tr>
												<td class="align-top py-0">
													<div class="py-2 mr-sm-3">Subject:</div>
												</td>
												<td class="align-top py-0">
													<input type="text" class="form-control py-2 px-0 border-0 rounded-0" placeholder="Add subject" name="subject" id="subject">
												</td>
											</tr>
											<tr>
												<td colspan="2">
												<textarea id="description" name="description"></textarea>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								<!-- /mail details -->

									<!-- Action toolbar -->
								<div class="bg-light rounded-top">
									<div class="navbar navbar-light bg-light navbar-expand-lg py-lg-2 rounded-top" style="padding-left:10px;">
										<div class="text-center d-lg-none w-100">
											<button type="button" class="navbar-toggler w-100 h-100" data-toggle="collapse" data-target="#inbox-toolbar-toggle-write">
												<i class="icon-circle-down2"></i>
											</button>
										</div>

										<div class="navbar-collapse text-center text-lg-left flex-wrap collapse" id="inbox-toolbar-toggle-write">

											<div class="mt-3 mt-lg-0 mr-lg-3">
												<button type="submit" class="btn bg-blue"><i class="icon-paperplane mr-2"></i> Send mail</button>
											</div>

										</div>
									</div>
								</div>
								<!-- /action toolbar -->


								<!-- Mail container -->
								<div class="card-body p-0">
									<div class="overflow-auto mw-100">
										<div class="summernote summernote-borderless" style="display: none;">

											<!-- Email sample (demo) -->
											<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
												<tbody><tr>
													<td>

														<!-- Hero -->
														<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
															<tbody><tr>
																<td align="center" bgcolor="#f67b7c" style="background-image: url('http://demo.interface.club/limitless/assets/images/bg.png'); background-repeat: repeat;">
																	<table width="640" border="0" cellpadding="0" cellspacing="0" align="center">
																		<tbody><tr>
																			<td width="100%" height="15"></td>
																		</tr>
																		<tr>
																			<td align="center">

																				<!-- Nav -->
																				<table width="600" border="0" cellpadding="0" cellspacing="0">
																					<tbody><tr>
																						<td width="100%" valign="middle">

																							<!-- Logo -->
																							<table width="280" border="0" cellpadding="0" cellspacing="0" align="left">
																								<tbody><tr>
																									<td height="60" valign="middle" width="100%" align="left">
																										<a href="#"><img width="125" src="../../../../global_assets/images/logo_light.png" alt=""></a>
																									</td>
																								</tr>
																							</tbody></table>
																							<!-- /logo -->


																							<!-- View Online -->
																							<table width="280" border="0" cellpadding="0" cellspacing="0" align="right">
																								<tbody><tr>
																									<td height="60" valign="middle" width="100%" align="right">
																										<a href="#" style="color: #ffffff;">Check the online version</a>
																									</td>
																								</tr>
																							</tbody></table>
																							<!-- /view Online -->

																						</td>
																					</tr>
																					<tr>
																						<td width="100%" height="30"></td>
																					</tr>
																				</tbody></table>
																				<!-- /nav -->


																				<!-- Title -->
																				<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
																					<tbody><tr>
																						<td valign="middle" align="center" style="font-size: 40px; color: #ffffff; line-height: 50px; font-weight: 300;">
																							We Create <span style="font-weight: 400;">Magic.</span>
																						</td>
																					</tr>
																				</tbody></table>
																				<!-- /title -->


																				<!-- Subtitle -->
																				<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
																					<tbody><tr>
																						<td width="100%" height="30"></td>
																					</tr>
																					<tr>
																						<td valign="middle" width="100%">
																							<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
																								<tbody><tr>
																									<td width="30"></td>
																									<td width="540" align="center" style="font-size: 14px; color: #ffffff; line-height: 24px;">
																										This is a demo of email template, please do not use it as a fully functional template. Sunt in culpa qui officia deserunt mollit anim id est laborum.
																									</td>
																									<td width="30"></td>
																								</tr>
																							</tbody></table>
																						</td>
																					</tr>
																				</tbody></table>
																				<!-- /subtitle -->


																				<!-- Button -->
																				<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
																					<tbody><tr>
																						<td height="40"></td>
																					</tr>
																					<tr>
																						<td width="auto" align="center">
																							<table border="0" cellpadding="0" cellspacing="0" align="center">
																								<tbody><tr>
																									<td width="auto" align="center" height="40" bgcolor="#344b61" style="border-radius: 20px; padding-left: 40px; padding-right: 40px; font-weight: 500;">
																										<a href="#" style="color: #ffffff; font-size: 12px; text-decoration: none; text-transform: uppercase; line-height: 34px;">More Information</a>
																									</td>
																								</tr>
																							</tbody></table>
																						</td>
																					</tr>
																				</tbody></table>
																				<!-- /button -->

																			</td>
																		</tr>
																		<tr>
																			<td width="100%" height="50"></td>
																		</tr>
																	</tbody></table>
																</td>
															</tr>
														</tbody></table>
														<!-- /hero -->


														<!-- We have a Great Workspace -->
														<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
															<tbody><tr>
																<td width="100%" valign="top" bgcolor="#ffffff" align="center">
																	<table width="640" border="0" cellpadding="0" cellspacing="0" align="center">
																		<tbody><tr>
																			<td width="100%" height="50"></td>
																		</tr>
																		<tr>
																			<td align="center">

																				<!-- Post -->
																				<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
																					<tbody><tr>
																						<td width="100%" align="center">
																							<table width="600" border="0" cellpadding="0" cellspacing="0" align="left">
																								<tbody><tr>
																									<td width="100%">
																										<a href="#">
																											<img src="../../../../global_assets/images/placeholders/cover.jpg" alt="" border="0" width="600" height="auto" style="border-radius: 4px;">
																										</a>
																									</td>
																								</tr>
																								<tr>
																									<td width="100%" height="25"></td>
																								</tr>
																								<tr>
																									<td height="35" width="100%" align="center" style="font-size: 24px; color: #444444; line-height: 32px; font-weight: 500;">
																										We have a Great Workspace
																									</td>
																								</tr>
																								<tr>
																									<td width="100%" height="15"></td>
																								</tr>
																								<tr>
																									<td valign="middle" width="100%" align="center" style="font-size: 14px; color: #808080; line-height: 22px;">
																										Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
																									</td>
																								</tr>
																								<tr>
																									<td width="100%" height="30"></td>
																								</tr>
																								<tr>
																									<td width="auto" align="center">
																										<table border="0" cellpadding="0" cellspacing="0" align="center">
																											<tbody><tr>
																												<td width="auto" align="center" height="38" bgcolor="#fa6f6f" style="border-radius: 20px; padding-left: 22px; padding-right: 22px;">
																													<a href="#" style="color: #ffffff; font-size: 12px; text-decoration: none; text-transform: uppercase; font-weight: 500; line-height: 32px; width: 100%;">Read more</a>
																												</td>
																											</tr>
																										</tbody></table>
																									</td>
																								</tr>
																							</tbody></table>
																						</td>
																					</tr>
																				</tbody></table>
																				<!-- /post -->

																			</td>
																		</tr>
																		<tr>
																			<td width="100%" height="50"></td>
																		</tr>
																	</tbody></table>
																</td>
															</tr>
														</tbody></table>
														<!-- /we have a Great Workspace -->


														<!-- The Best Prices for You -->
														<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
															<tbody><tr>
																<td width="100%" height="1" bgcolor="#dddddd" style="font-size: 1px; line-height: 1px;">&nbsp;</td>
															</tr>
															<tr>
																<td align="center" width="100%" valign="top" bgcolor="#fafafa" style="background-color: #fafafa;">
																	<table width="640" border="0" cellpadding="0" cellspacing="0" align="center">
																		<tbody><tr>
																			<td width="100%" height="50"></td>
																		</tr>
																		<tr>
																			<td align="center">

																				<!-- Header -->
																				<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
																					<tbody><tr>
																						<td align="center">
																							<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
																								<tbody><tr>
																									<td align="center" valign="middle" style="font-size: 24px; color: #444444; line-height: 32px; font-weight: 500;">
																										The Best Prices for You
																									</td>
																								</tr>
																								<tr>
																									<td width="100%" height="30"></td>
																								</tr>
																								<tr>
																									<td width="100%">
																										<table width="100" border="0" cellpadding="0" cellspacing="0" align="center">
																											<tbody><tr>
																												<td height="1" bgcolor="#f67b7c" style="font-size: 1px; line-height: 1px;">&nbsp;</td>
																											</tr>
																										</tbody></table>
																									</td>
																								</tr>
																								<tr>
																									<td width="100%" height="30"></td>
																								</tr>
																								<tr>
																									<td align="center" valign="middle" width="100%" style="font-size: 14px; color: #808080; line-height: 22px; font-weight: 400;">
																										Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore...
																									</td>
																								</tr>
																								<tr>
																									<td width="100%" height="30"></td>
																								</tr>
																							</tbody></table>
																						</td>
																					</tr>
																				</tbody></table>
																				<!-- /header -->


																				<!-- Prices -->
																				<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
																					<tbody><tr>
																						<td width="100%" valign="top" align="center">

																							<!-- Basic license -->
																							<table width="290" border="0" cellpadding="0" cellspacing="0" align="left" bgcolor="#ffffff" style="border: 1px solid #dddddd; background-color: #ffffff;">
																								<tbody><tr>
																									<td width="290" valign="top" align="center">
																										<table width="294" border="0" cellpadding="0" cellspacing="0" align="center">
																											<tbody><tr>
																												<td height="15">
																												</td>
																											</tr>
																											<tr>
																												<td align="center" style="color: #444444; font-size: 17px; line-height: 24px; padding: 0px 5px; font-weight: 500;">
																													Regular License
																												</td>
																											</tr>
																											<tr>
																												<td height="15">
																												</td>
																											</tr>
																											<tr>
																												<td width="100" height="1" bgcolor="#e9e9e9" style="font-size: 1px; line-height: 1px;">&nbsp;</td>
																											</tr>
																											<tr>
																												<td height="20">
																												</td>
																											</tr>
																											<tr>
																												<td align="center" style="color: #808080; font-size: 14px; line-height: 22px; padding: 2px 5px; font-weight: 400;">
																													Non-Responsive layout
																												</td>
																											</tr>
																											<tr>
																												<td height="10">
																												</td>
																											</tr>
																											<tr>
																												<td style="text-align: center; color: #808080; font-size: 14px; line-height: 22px; padding: 2px 5px;">
																													Builder excluded
																												</td>
																											</tr>
																											<tr>
																												<td height="10">
																												</td>
																											</tr>
																											<tr>
																												<td style="text-align: center; color: #808080; font-size: 14px; line-height: 22px; padding: 2px 5px;">
																													Instant Access
																												</td>
																											</tr>
																											<tr>
																												<td height="25">
																												</td>
																											</tr>
																											<tr>
																												<td height="24" style="text-align: center; color: #444444; font-size: 38px; line-height: 15px; padding: 6px 5px 6px 5px; font-weight: 700;">
																													<span style="font-size: 18px; position: relative; bottom: 12px;">$ </span>49<span style="font-size: 14px; color: #808080; font-style: italic;"> / month</span>
																												</td>
																											</tr>
																											<tr>
																												<td height="25">
																												</td>
																											</tr>
																											<tr>
																												<td width="auto" align="center">
																													<table border="0" cellpadding="0" cellspacing="0" align="center">
																														<tbody><tr>
																															<td width="auto" align="center" height="38" bgcolor="#fa6f6f" style="border-radius: 20px; padding-left: 22px; padding-right: 22px; font-weight: 500;">
																																<a href="#" style="color: #ffffff; font-size: 12px; text-decoration: none; text-transform: uppercase; line-height: 32px;">Sign Up</a>
																															</td>
																														</tr>
																													</tbody></table>
																												</td>
																											</tr>
																											<tr>
																												<td height="30">
																												</td>
																											</tr>
																										</tbody></table>
																									</td>
																								</tr>
																							</tbody></table>
																							<!-- /basic license -->


																							<!-- Space -->
																							<table width="1" border="0" cellpadding="0" cellspacing="0" align="left">
																								<tbody><tr>
																									<td width="100%" height="30"></td>
																								</tr>
																							</tbody></table>
																							<!-- /space -->


																							<!-- OEM license -->
																							<table width="290" border="0" cellpadding="0" cellspacing="0" align="right" bgcolor="#ffffff" style="border: 1px solid #dddddd; background-color: #ffffff;">
																								<tbody><tr>
																									<td width="294" valign="top">
																										<table width="290" border="0" cellpadding="0" cellspacing="0" align="center">
																											<tbody><tr>
																												<td height="15">
																												</td>
																											</tr>
																											<tr>
																												<td align="center" style="color: #444444; font-size: 17px; line-height: 26px; padding: 0px 5px; font-weight: 500;">
																													OEM License
																												</td>
																											</tr>
																											<tr>
																												<td height="15">
																												</td>
																											</tr>
																											<tr>
																												<td width="100" height="1" bgcolor="#e9e9e9" style="font-size: 1px; line-height: 1px;">&nbsp;</td>
																											</tr>
																											<tr>
																												<td height="20">
																												</td>
																											</tr>
																											<tr>
																												<td align="center" style="color: #808080; font-size: 14px; line-height: 22px; padding: 2px 5px;">
																													Responsive layout
																												</td>
																											</tr>
																											<tr>
																												<td height="10">
																												</td>
																											</tr>
																											<tr>
																												<td align="center" style="color: #808080; font-size: 14px; line-height: 22px; padding: 2px 5px;">
																													Builder included
																												</td>
																											</tr>
																											<tr>
																												<td height="10">
																												</td>
																											</tr>
																											<tr>
																												<td align="center" style="color: #808080; font-size: 14px; line-height: 22px; padding: 2px 5px;">
																													Instant Access
																												</td>
																											</tr>
																											<tr>
																												<td height="25">
																												</td>
																											</tr>
																											<tr>
																												<td align="center" height="24" style="color: #444444; font-size: 38px; line-height: 15px; padding: 6px 5px 6px 5px; font-weight: 700;">
																													<span style="font-size: 18px; position: relative; bottom: 12px;">$ </span>80<span style="font-size: 14px; color: #808080; font-style: italic;"> / month</span>
																												</td>
																											</tr>
																											<tr>
																												<td height="25">
																												</td>
																											</tr>
																											<tr>
																												<td width="auto" align="center">
																													<table border="0" cellpadding="0" cellspacing="0" align="center">
																														<tbody><tr>
																															<td width="auto" align="center" height="38" bgcolor="#fa6f6f" style="border-radius: 20px; padding-left: 22px; padding-right: 22px; font-weight: 500;">
																																<a href="#" style="color: #ffffff; font-size: 12px; text-decoration: none; text-transform: uppercase; line-height: 32px;">Sign Up</a>
																															</td>
																														</tr>
																													</tbody></table>
																												</td>
																											</tr>
																											<tr>
																												<td height="30">
																												</td>
																											</tr>
																										</tbody></table>
																									</td>
																								</tr>
																							</tbody></table>
																							<!-- /OEM license -->

																						</td>
																					</tr>
																				</tbody></table>
																				<!-- /prices -->

																			</td>
																		</tr>
																		<tr>
																			<td height="60"></td>
																		</tr>
																	</tbody></table>
																</td>
															</tr>
														</tbody></table>
														<!-- /the Best Prices for You -->


														<!-- Let our Clients Convince you -->
														<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
															<tbody><tr>
																<td align="center" width="100%" valign="top" bgcolor="#4f97e2" style="background-image: url('http://demo.interface.club/limitless/assets/images/bg.png'); background-color: #4f97e2; background-repeat: repeat;">
																	<table width="640" border="0" cellpadding="0" cellspacing="0" align="center">
																		<tbody><tr>
																			<td width="100%" height="50"></td>
																		</tr>
																		<tr>
																			<td align="center">

																				<!-- Header -->
																				<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
																					<tbody><tr>
																						<td valign="middle" align="center" width="100%" style="font-size: 24px; color: #ffffff; line-height: 32px; font-weight: 500;">
																							Let our Clients Convince you
																						</td>
																					</tr>
																					<tr>
																						<td width="100%" height="30"></td>
																					</tr>
																					<tr>
																						<td width="100%">
																							<table width="100" border="0" cellpadding="0" cellspacing="0" align="center">
																								<tbody><tr>
																									<td width="100" height="1" bgcolor="#ffffff" style="font-size: 1px; line-height: 1px;">&nbsp;</td>
																								</tr>
																							</tbody></table>
																						</td>
																					</tr>
																					<tr>
																						<td width="100%" height="30"></td>
																					</tr>
																					<tr>
																						<td align="center" valign="middle" width="100%" style="font-size: 14px; color: #ffffff; line-height: 22px;">
																							Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt <b>mollit anim id est laborum</b>. Sed ut perspiciatis unde omnis iste...
																						</td>
																					</tr>
																					<tr>
																						<td width="100%" height="30"></td>
																					</tr>
																				</tbody></table>
																				<!-- /header -->


																				<!-- Testimonials -->
																				<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
																					<tbody><tr>
																						<td width="100%">

																							<!-- Left table -->
																							<table width="275" border="0" cellpadding="0" cellspacing="0" align="left" style="border-radius: 4px;">
																								<tbody><tr>
																									<td width="100%" align="center">
																										<a href="#">
																											<img src="../../../../global_assets/images/placeholders/placeholder.jpg" alt="" border="0" width="83" height="auto" style="border-radius: 100px;">
																										</a>
																									</td>
																								</tr>
																								<tr>
																									<td height="30"></td>
																								</tr>
																								<tr>
																									<td valign="middle" align="center" style="font-size: 14px; color: #ffffff; line-height: 22px;">
																										Excepteur sint occaecat cupidatat non proident id est laborum.
																									</td>
																								</tr>
																								<tr>
																									<td height="20"></td>
																								</tr>
																								<tr>
																									<td align="center" style="font-size: 15px; color: #ffffff; line-height: 22px;">
																										<span style="font-weight: 700; font-size: 12px; text-transform: uppercase; color: #fff;">Cris Costo</span>
																									</td>
																								</tr>
																							</tbody></table>
																							<!-- /left table -->


																							<!-- Space -->
																							<table width="1" border="0" cellpadding="0" cellspacing="0" align="left">
																								<tbody><tr>
																									<td width="100%" height="40"></td>
																								</tr>
																							</tbody></table>
																							<!-- /space -->


																							<!-- Right table -->
																							<table width="275" border="0" cellpadding="0" cellspacing="0" align="right" style="border-radius: 4px;">
																								<tbody><tr>
																									<td width="100%" align="center">
																										<a href="#">
																											<img src="../../../../global_assets/images/placeholders/placeholder.jpg" alt="" border="0" width="83" height="auto" style="border-radius: 100px;">
																										</a>
																									</td>
																								</tr>
																								<tr>
																									<td height="30"></td>
																								</tr>
																								<tr>
																									<td valign="middle" align="center" style="font-size: 14px; color: #ffffff; line-height: 22px;">
																										Sunt in culpa qui officia deserunt mollit anim id est laborum.
																									</td>
																								</tr>
																								<tr>
																									<td height="20"></td>
																								</tr>
																								<tr>
																									<td align="center" style="font-size: 15px; line-height: 22px;">
																										<span style="font-weight: 700; font-size: 12px; text-transform: uppercase; color: #ffffff;">Jason Kenny</span>
																									</td>
																								</tr>
																							</tbody></table>
																							<!-- /right table -->

																						</td>
																					</tr>
																				</tbody></table>
																				<!-- /testimonials -->

																			</td>
																		</tr>
																		<tr>
																			<td width="100%" height="50"></td>
																		</tr>
																	</tbody></table>
																</td>
															</tr>
														</tbody></table>
														<!-- /let our Clients Convince you -->


														<!-- Footer -->
														<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
															<tbody><tr>
																<td align="center" width="100%" valign="top" bgcolor="#344b61">

																	<!-- Wrapper -->
																	<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
																		<tbody><tr>
																			<td width="100%" height="40" align="center" valign="middle" style="font-size: 12px; color: #aebecd;">
																				<a href="#" style="color: #ffffff;">Unsubscribe</a>

																				<span style="color: #ffffff;">&nbsp;/&nbsp;</span>

																				<a href="#" style="color: #ffffff;">Send to a friend</a>
																			</td>
																		</tr>
																	</tbody></table>
																	<!-- /wrapper -->

																</td>
															</tr>
														</tbody></table>
														<!-- /footer -->

													</td>
												</tr>
											</tbody></table>
											<!-- /email sample (demo) -->

										</div>
									</div>
								</div>
								<!-- /mail container -->

							</div>
							</form>
							<!-- /single mail -->

					</div>



<script>
ClassicEditor
   .create( document.querySelector( '#description' ) )
   .then( editor => {
       console.log( editor );
   } )
   .catch( error => {
       console.error( error );
   } );
</script>