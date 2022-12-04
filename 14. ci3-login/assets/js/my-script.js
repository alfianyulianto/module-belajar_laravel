$(function () {
	// MENU
	// trigert tampil_data_menu
	tampil_data_menu();

	// selecting data menu
	function tampil_data_menu() {
		$.ajax({
			type: "post",
			url: "http://localhost:8080/ci3-login/menu/getDataMenu",
			dataType: "json",
			success: (result) => {
				let html = "";
				for (let i = 0; i < result.length; i++) {
					let number = i;
					html +=
						"<tr>" +
						"<td>" +
						++number +
						"</td>" +
						"<td>" +
						result[i].menu +
						"</td>" +
						"<td>" +
						'<a href="" class="badge rounded-pill text-bg-warning editMenuModal me-2" data-bs-toggle="modal" data-bs-target="#newMenuModal" data-id="' +
						result[i].id +
						'">edit</a>' +
						'<a href="" class="badge rounded-pill text-bg-danger deleteMenu" data-id="' +
						result[i].id +
						'">delete</a>' +
						"</td>" +
						"</tr>";
				}
				$("tbody.menu").html(html);
			},
		});
	}

	// insert data menu
	$("body").on("click", ".btnAddMenu", function () {
		const menu = $("#menu").val();
		if (!menu) {
			// // // // // // // // // // // // // // // // //
		} else {
			$.ajax({
				url: "http://localhost:8080/ci3-login/menu",
				data: { menu: menu },
				method: "post",
				success: function (result) {
					Swal.fire({
						icon: "success",
						title: "Added menu data successfull!",
						showConfirmButton: false,
						timer: 2000,
						timerProgressBar: true,
					}).then((result) => {
						// console.log(result);
						if (result.isDismissed) {
							tampil_data_menu();

							const alert =
								"<div class='alert alert-success alert-dismissible fade show' role='alert'>" +
								"New menu added!" +
								"<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div >";
							$(".alert").html(alert);
						}
					});
				},
				error: (err) => {
					const alert =
						"<div class='alert alert-danger alert-dismissible fade show' role='alert'>" +
						"New menu not been added!" +
						"<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div >";
					$(".alert").html(alert);
				},
			});
		}
	});

	// update data
	$("body").on("click", ".btnEditMenu", function () {
		// let idMenu = $(".editMenuModal").data("id");
		let idMenu = $("#id").val();
		// alert(idMenu);
		const menu = $("#menu").val();
		$.ajax({
			url: "http://localhost:8080/ci3-login/menu/editMenu",
			data: { id: idMenu, menu: menu },
			method: "post",
			success: function (result) {
				Swal.fire({
					icon: "success",
					title: "Updated data menu successfull!",
					showConfirmButton: false,
					timer: 2000,
					timerProgressBar: true,
				}).then((result) => {
					// console.log(result);
					if (result.isDismissed) {
						tampil_data_menu();

						const alert =
							"<div class='alert alert-success alert-dismissible fade show' role='alert'>" +
							"Menu has been edit!" +
							"<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div >";
						$(".alert").html(alert);
					}
				});
			},
			error: (err) => {
				const alert =
					"<div class='alert alert-danger alert-dismissible fade show' role='alert'>" +
					"Menu not been edit!" +
					"<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div >";
				$(".alert").html(alert);
			},
		});
	});

	// delete data menu
	$("tbody").on("click", ".deleteMenu", function (e) {
		e.preventDefault();
		const idMenu = $(this).data("id");
		Swal.fire({
			title: "Are you sure to delete?",
			text: "Select Logout below if you are ready to end your current session.",
			icon: "warning",
			showCancelButton: true,
			confirmButtonText: "Yes, delete!",
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: "http://localhost:8080/ci3-login/menu/deleteMenu/" + idMenu,
					method: "post",
					success: (result) => {
						Swal.fire({
							icon: "success",
							title: "Deleted menu data successfull!",
							showConfirmButton: false,
							timer: 2000,
							timerProgressBar: true,
						}).then((result) => {
							// console.log(result);
							if (result.isDismissed) {
								tampil_data_menu();
								const alert =
									"<div class='alert alert-success alert-dismissible fade show' role='alert'>" +
									"Menu has been deleted!" +
									"<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div >";
								$(".alert").html(alert);
							}
						});
					},
					error: (err) => {
						const alert =
							"<div class='alert alert-danger alert-dismissible fade show' role='alert'>" +
							"Menu not been deleted!" +
							"<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div >";
						$(".alert").html(alert);
					},
				});
			} else {
				window.location.href;
			}
		});
	});

	// menu modal
	$(".addMenuModal").on("click", function () {
		$("#newMenuModalLabel").html("Add New Menu");
		$(".modal-footer button#btnMenu").html("Add");
		$("input#menu").val("");
		$("#btnMenu").addClass("btnAddMenu");
		$("#btnMenu").removeClass("btnEditMenu");
	});
	$("tbody").on("click", ".editMenuModal", function () {
		$("#newMenuModalLabel").html("Edit Menu");
		$(".modal-footer button#btnMenu").html("Edit");
		$("#btnMenu").removeClass("btnAddMenu");
		$("#btnMenu").addClass("btnEditMenu");

		const idMenu = $(this).data("id");
		$.ajax({
			url: "http://localhost:8080/ci3-login/menu/getMenuById/" + idMenu,
			method: "post",
			dataType: "json",
			success: function (result) {
				$("input[name=id]").val(result[0].id);
				$("input[name=menu]").val(result[0].menu);
				$(".modal-content form").attr(
					"action",
					"http://localhost:8080/ci3-login/menu/ediMenu/" + result[0].id
				);
			},
		});
	});

	// submenu modal
	$(".addSubmenuModal").on("click", function () {
		$("#newSubmenuModalLabel").html("Add New Submenu");
		$(".modal-footer button#btnSubmenu").html("Add");
		$("input#id").val("");
		$("input#title").val("");
		$("select#menu_id").val("");
		$("input#url").val("");
		$("input#icon").val("");
		$("#btnSubmenu").addClass("btnAddSubmenu");
		$("#btnSubmenu").removeClass("btnEditSubmenu");
	});
	$(".editSubmenuModal").on("click", function () {
		$("#newSubmenuModalLabel").html("Edit Submenu");
		$(".modal-footer button#btnSubmenu").html("Edit");
		$("#btnSubmenu").removeClass("btnAddSubmenu");
		$("#btnSubmenu").addClass("btnEditSubmenu");

		const idMenu = $(this).data("id");
		$.ajax({
			url: "http://localhost:8080/ci3-login/menu/getSubmenuById/" + idMenu,
			method: "post",
			dataType: "json",
			success: function (result) {
				// console.log(result);
				$("input[name=id]").val(result[0].id);
				$("input[name=title]").val(result[0].title);
				$("select[name=menu_id]").val(result[0].menu_id);
				$("input[name=url]").val(result[0].url);
				$("input[name=icon]").val(result[0].icon);
				$("input[name=is_active]").val(result[0].is_active);
				$(".modal-content form").attr(
					"action",
					"http://localhost:8080/ci3-login/menu/editSubmenu/" + result[0].id
				);
			},
		});
	});

	// role modal
	$(".addRoleModal").on("click", function () {
		$("#newRoleModalLabel").html("Add New Role");
		$(".modal-footer button#btnRole").html("Add");
		$("input#role").val("");
		$("#btnRole").addClass("btnAddRole");
		$("#btnRole").removeClass("btnEditRole");
	});
	$(".editRoleModal").on("click", function () {
		$("#newRoleModalLabel").html("Edit Role");
		$(".modal-footer button#btnRole").html("Edit");
		$("#btnRole").removeClass("btnAddRole");
		$("#btnRole").addClass("btnEditRole");

		const idMenu = $(this).data("id");
		$.ajax({
			url: "http://localhost:8080/ci3-login/admin/getRoleById/" + idMenu,
			method: "post",
			dataType: "json",
			success: function (result) {
				console.log(result);
				$("input[name=id]").val(result[0].id);
				$("input[name=role]").val(result[0].role);
				$(".modal-content form").attr(
					"action",
					"http://localhost:8080/ci3-login/admin/editRole/" + result[0].id
				);
			},
		});
	});

	// sweetalert logout
	$(".logout").on("click", function (e) {
		e.preventDefault();
		Swal.fire({
			title: "Are you sure to leave?",
			text: "Select Logout below if you are ready to end your current session.",
			icon: "warning",
			showCancelButton: true,
			confirmButtonText: "Yes, logout!",
		}).then((result) => {
			if (result.isConfirmed) {
				window.location = $(this).attr("href");
			} else {
				window.location.href;
			}
		});
	});

	// change access
	$(".check-access").on("click", function () {
		const role_id = $(this).data("role");
		const menu_id = $(this).data("menu");

		console.log(role_id);
		console.log(menu_id);

		$.ajax({
			url: "http://localhost:8080/ci3-login/admin/chengeAccess",
			type: "post",
			data: { role_id: role_id, menu_id: menu_id },
			success: (result) => {
				window.location.href =
					"http://localhost:8080/ci3-login/admin/roleAccess/" + role_id;
			},
		});
	});
});
